<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Faker;

use App\Entity\Resource;
use App\Entity\Question;
use App\Entity\Taxonomy;
use App\Entity\Comment;
use App\Entity\Lesson;
use App\Entity\Author;
use App\Entity\Term;

class LessonFixtures extends Fixture implements DependentFixtureInterface
{

    use Generate;

    const STATUS = ['draft', 'publish', 'future', 'private', 'inherit', 'pending'];
    const TYPES = ['free', 'closed'];

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        $taxonomies = ['JS', 'PHP', 'Symfony', 'Python', 'Postgres', 'Go', 'DataViz', 'Statistiques'];
        $authors = $manager->getRepository(Author::class)->findAll();

        $category = new Term;
        $category->setName('category');
        $manager->persist($category);

        $tag = new Term;
        $tag->setName('tag');
        $manager->persist($tag);

        $type = new Term;
        $type->setName('type');
        $manager->persist($type);

        foreach (range(0, 100) as $_) {
            $taxName = $taxonomies[rand(0, count($taxonomies) - 1)];
            $lesson = new Lesson;
            $lesson->setName($taxName);
            $lesson->setStatus(self::STATUS[rand(0,5)]);
            // date de création
            $date = new \DateTime('2020-01-01');
            $day = random_int(10, 1000);
            $date->add(new \DateInterval("P" . $day . "D"));
            $lesson->setCreatedAt($date);
            $rate = rand(1, 10);
            $lesson->setRate($rate);

             // taxonomy type
             $taxonomy = new Taxonomy;
             $taxonomy->setTerm($type);
             $taxonomy->setName(self::TYPES[rand(0,1)]);
             $manager->persist($taxonomy);
             $lesson->addTaxonomy($taxonomy);

            $lesson->setContent($this->lorem(rand(10, 20)));
            $lesson->addAuthor($authors[rand(0, count($authors) - 1)]);

            // taxonomy category
            $taxonomy = new Taxonomy;
            $taxonomy->setTerm($category);
            $taxonomy->setName($taxName);
            $manager->persist($taxonomy);
        
            $lesson->addTaxonomy($taxonomy);

            // taxonomies
            $tagsNames = ['JS', 'Basic Code', 'Discovery', 'Statistic', 'Database', 'Observable'];
            shuffle($tagsNames);
            foreach ($tagsNames as $name) {
                $tagTaxo = new Taxonomy;
                $tagTaxo->setTerm($tag);
                $tagTaxo->setName($name);
                $manager->persist($tagTaxo);

                $lesson->addTaxonomy($tagTaxo);

                if(rand(0, 2) === 1) break;
            }

            // resource
            $resource = new Resource;
            $lorems = [];
            foreach(range(0, 10) as $_) $lorems[] = $this->lorem(rand(2, 10)) ;
            $resource->setContent( $lorems );

            $manager->persist($resource);

            foreach (range(0, rand(2, 10)) as $_) {
                $comment = new Comment;
                $comment->setTitle($faker->word());
                $comment->setContent($this->lorem(rand(2, 10)));

                $manager->persist($comment);
            }

            foreach (range(0, rand(2, 10)) as $id) {
                $question = new Question;
                $question->setName($taxName . '_'. $id);
                $lorems = [];
                foreach(range(0, 200) as $_) $lorems[] = $this->lorem(rand(2, 10)) ;
                $question->setChoices( $lorems );
                $lesson->addQuestion($question);

                $manager->persist($question);
            }

            $manager->persist($lesson);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AuthorFixtures::class,
        );
    }
}
