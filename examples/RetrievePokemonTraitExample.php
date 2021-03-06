<?php

require __DIR__ . '/../vendor/autoload.php';

use NicklasW\PkmGoApi\Authentication\Config\Config;
use NicklasW\PkmGoApi\Authentication\Factory\Factory;
use NicklasW\PkmGoApi\Kernels\ApplicationKernel;
use POGOProtos\Enums\PokemonId;

class RetrievePokemonTraitExample {

    /**
     * Run the example.
     */
    public function run()
    {
        // Create the authentication config
        $config = new Config();
        $config->setProvider(Factory::PROVIDER_PTC);
        $config->setUser('INSERT_USER');
        $config->setPassword('INSERT_PASSWORD');

        // Create the authentication manager
        $manager = Factory::create($config);

        // Initialize the pokemon go application
        $application = new ApplicationKernel($manager);

        // Retrieve the pokemon go api instance
        $pokemonGoApi = $application->getPokemonGoApi();

        // Retrieve the inventory
        $inventory = $pokemonGoApi->getInventory();

        // Retrieve the poke bank
        $pokeBank = $inventory->getPokeBank();

        // Retrieve a pokemon of type pidgey
        $pokemon = $pokeBank->getPokemons()->first();

        // Check if we retrieved a pokemon
        if (!$pokemon) {
            throw new Exception('Cannot find any pokemons in your PokeBank.');
        }

        echo sprintf("Pokemon %s, Id: %s, Cp: %d, type: %s, attacks: %s and %s, ", $pokemon->getName(), $pokemon->getId(), $pokemon->getCp(), $pokemon->getType1String(), $pokemon->getMove1String(), $pokemon->getMove2String());

    }

}

$example = new RetrievePokemonTraitExample();
$example->run();