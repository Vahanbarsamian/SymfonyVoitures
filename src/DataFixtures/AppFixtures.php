<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Modele;
use App\Entity\Voiture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /**
         * Marques
         */
        $m1 = new Marque();
        $m1->setLibelle('Yotota');
        $manager->persist($m1);

        $m2 = new Marque();
        $m2->setLibelle('Jeupo');
        $manager->persist($m2);

        /**
         * Modeles
         */
        $mod1 = new Modele();
        $mod1->setLibelle('Rayis')
            ->setPrixMoyen(15000)
            ->setImage('modele1.jpg')
            ->setMarque($m1);
        $manager->persist($mod1);

        $mod2 = new Modele();
        $mod2->setLibelle('008')
            ->setPrixMoyen(12000)
            ->setImage('modele2.jpg')
            ->setMarque($m2);
        $manager->persist($mod2);

        $mod3 = new Modele();
        $mod3->setLibelle('009')
            ->setPrixMoyen(14000)
            ->setImage('modele3.jpg')
            ->setMarque($m2);
        $manager->persist($mod3);

        $mod4 = new Modele();
        $mod4->setLibelle('010')
            ->setPrixMoyen(15000)
            ->setImage('modele4.jpg')
            ->setMarque($m2);
        $manager->persist($mod4);

        $mod5 = new Modele();
        $mod5->setLibelle('011')
            ->setPrixMoyen(16000)
            ->setImage('modele5.jpg')
            ->setMarque($m2);
        $manager->persist($mod5);

        $mod6 = new Modele();
        $mod6->setLibelle('012')
            ->setPrixMoyen(16000)
            ->setImage('modele6.jpg')
            ->setMarque($m2);
        $manager->persist($mod6);

        /**
         * Voitures
         */
        $faker = \Faker\Factory::create('fr_FR');
        $modeles = [$mod1, $mod2, $mod2, $mod3, $mod4, $mod5, $mod6];
        foreach ($modeles as $mod) {
            $nb = random_int(3, 5);
            for ($i = 1; $i < $nb; $i++) {
                $voit = new Voiture();
                $voit->setImmatriculation(
                    $faker->regexify('^[A-Z]{2}-[0-9]{3}-[A-Z]{2}$')
                )
                    ->setNbPorte($faker->randomElement($array = array(3, 5)))
                    ->setAnnee($faker->numberBetween(2000, 2019))
                    ->setModele($mod);
                $manager->persist($voit);
            }
        }
        $manager->flush();
    }
}
