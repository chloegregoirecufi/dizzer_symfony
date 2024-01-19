<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Album;
use App\Entity\Music;
use App\Entity\Artiste;
use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtured extends Fixture
{
    private $encoder; //def d'une propriété privé ou l'on instanciera l'interface d'encodage du mdp

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->encoder = $hasher; //injection de l'interface dans la propriete 
    }


    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
    

        $faker = Factory::create('fr_FR');
        $artisteType = ['Rihanna','Pnl','Lana del Rey','David Guette','Adele','Gambi','The Weeknd','Avicii','Aurora','la bul','jul'];
        $albumType =['Anti', 'Le Monde Chico', 'Born to Die', 'Nothing but the Beat', '21', 'La vie est belle', 'Starboy', 'true', 'La machine', 'All my demons greeting me as friend'];
        $imagesType = ['adele.png','aurora.png','avicii.png','bul.png','david.png','gambi.png','jul.png','lana.png','pnl.png','rihanna.png','weeknd.png'];
        $musicType = ['c\'est pas des lol','need me', 'Deux frères', 'Young and beautiful','Sexy bitch','skyfall','popopo','creepin','Hey brother','running with the wolves','Mange-moi l\'ananas' ];
        $songType= ['ananas.mp3', 'brother.mp3', 'creepin.mp3','freres.mp3','lol.mp3','need.mp3','running.mp3','sexy_bitch.mp3','skfall','young.mp3'];
        $cats = ["Rock alternatif","Hip-hop ", "Électro-swing", "Reggae", "Chillwave", "Musique classique contemporaine", "Metal progressif", "Funk", "Jazz fusion", "Musique folklorique celtique" ];

        //cration musique 11
        for($m = 0;$m < 11; $m++){
            $music = new Music();
            $music->setTitle($musicType[rand(0, count($musicType)-1)])
                ->setSong($songType[rand(0, count($songType)-1)])
                ->setDate($faker->dateTime('2005-01-01'));
            
            $manager->persist($music);
            $this->addReference('music-'. $m, $music);

        }


        //boucle création des artistes 11
        for($ar = 0; $ar < 11; $ar++){
            $artiste = new Artiste();
            $artiste->setName($artisteType[rand(0, count($artisteType)-1)])
                ->setAge($faker->dateTime('2005-01-01'))
                ->setBiography($faker->words(25, true));

            $manager->persist($artiste);
            $this->addReference('artiste-' .$ar, $artiste);

            //ajout de relation avec les musiques
                $artiste->addMusic($this->getReference('music-' . rand(0,10)));
                    
        }


        //création des catégories
        foreach ($cats as $key => $cat){
                $categories = new Categories();
                $categories->setType($cat);

            $manager->persist($categories);

            $this->addReference("cat-".$key, $categories);
            //ajout de relation avec les musiques
                $categories->addMusic($this->getReference('music-' . rand(0,10)));

        }

        //Boucle création album 11
        for($al = 0; $al < 11; $al++){
            $album = new Album();
            $album->setName($albumType[rand(0, count($albumType)-1)])
                ->setImagePath($imagesType[rand(0, count($imagesType)-1)])
                ->setDate($faker->dateTime('2005-01-01'));
            
            $manager->persist($album);
            $this->addReference('album-'.$al, $album);

            //ajout de relation avec les musiques
                $album->addMusic($this->getReference('music-' . rand(0,10)));
            
            //ajout de la relation avec artiste
                $album->addArtiste($this->getReference('artiste-' . rand(0,10)));
        

        }
       

        //création de user 3
        for($u = 0;$u < 3; $u++){
            $user = new User();
            $user->setEmail($faker->companyEmail)
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($this->encoder->hashPassword($user, 'admin2024'))
                ->setFistname("clo")
                ->setLastname("clo")
                ->setAge($faker->dateTime('2002-05-23'))
                ->setCity('Perpignan')
                ->setPhone('06.09.09.11.09');
            
            $manager->persist($user);
            $this->addReference('user-'.$u, $user);

            //ajout de relation avec les musiques
                $user->addMusic($this->getReference('music-' . rand(0,10)));

        }
        $manager->flush();
    }
}
