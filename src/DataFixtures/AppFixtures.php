<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $type1 = new Type();
        $type1->setLabel('Feu');
        $manager->persist($type1);

        $type2 = new Type();
        $type2->setLabel('Eau');
        $manager->persist($type2);

        $type3 = new Type();
        $type3->setLabel('Electrique');
        $manager->persist($type3);

        $type4 = new Type();
        $type4->setLabel('Normal');
        $manager->persist($type4);

        $tabPokemon = [
            ['Pikachu','Attaque tonerre',[$type3,$type4]],['Salameche','Attaque feu',[$type1]],['Tiplouf','Attaque surf',[$type3]],
            ['Arcanin','Attaque feu',[$type1]],['Ptitard','Attaque surf',[$type3]],['Tentacool','Attaque eau',[$type3]],
            ['Magneton','Attaque electrocution',[$type2]],['Magneti','Attaque electrocution',[$type2]],['Otaria','Attaque surf',[$type3]],
            ['Poissoroy','Attaque surf',[$type3]],['Poissirene','Attaque surf',[$type3]],['Magmar','Attaque feu',[$type1]],
            ['Pyroli','Attaque feu',[$type1,$type4]],['Dracaufeu','Attaque feu',[$type1,$type4]],['Reptincel','Attaque feu',[$type1]],
            ['Caninos','Attaque feu',[$type1]],['Tetarte','Premiere evolution de ptitard',[$type3]],['Tartard','Derniere evolution de ptitard',[$type3]],
            ['Ponyta','Attaque feu',[$type1]],['Galopa','Evolution de ponyta',[$type1,$type4]]
        ];

        $count = 0;

        foreach ($tabPokemon as $item ) {
            $pokemon = new Pokemon();
            $pokemon->setName($item[0])->setDescription($item[1]);
            foreach ($item[2] as $type) {
                $pokemon->addType($type);
            }
            $manager->persist($pokemon);
            $count+=1;
        }

        $manager->flush();
    }
}
