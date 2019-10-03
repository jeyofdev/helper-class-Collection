<?php

    namespace jeyofdev\Helper\ManipulateArray\Tests;


    use jeyofdev\Helper\ManipulateArray\Collection;
    use PHPUnit\Framework\TestCase;


    final class CollectionTest extends TestCase
    {
        /**
         * @var Collection
         */
        private $collection;


        /**
         * @var array
         */
        private $datas = [];



        /**
         * @param array $datas
         * @return Collection
         */
        public function getCollection (array $datas = []) : Collection
        {
            $this->datas = $datas;
            return new Collection($datas);
        }



        /**
         * @test
         */
        public function testSetValueOfArray() : void
        {
            $this->collection = $this->getCollection();
            $this->datas = $this->collection
                ->set("username", "john")
                ->set("job", "dev");

            $this->assertNotEmpty($this->datas);
        }



        /**
         * @test
         */
        public function testGetArray() : void
        {
            $this->collection = $this->getCollection();
            $this->datas = $this->collection
                ->set("username", "john")
                ->set("job", "dev")
                ->getDatas();

            $this->assertEquals(["username" => "john", "job" => "dev"], $this->datas);
            $this->assertCount(2, $this->datas);
        }



        /**
         * @test
         */
        public function testGetValueOfIndex() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php", "note" => "11"],
                ["name" => "Marc", "language" => "javascript", "note" => "15"],
                ["name" => "Emily", "language" => "python", "note" => "13"]
            ]);

            $syntaxOne = $this->collection->get("0.language");
            $syntaxTwo = $this->collection->get("2")->get("language");

            $this->assertEquals("php", $syntaxOne);
            $this->assertEquals("python", $syntaxTwo);
        }



        /**
         * @test
         */
        public function testGetAllValues() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php", "note" => "11"],
                ["name" => "Marc", "language" => "javascript", "note" => "15"],
                ["name" => "Emily", "language" => "python", "note" => "13"]
            ]);

            $usernames = $this->collection->get("0")->get();

            $this->assertEquals(["Jean", "php", "11"], $usernames);
        }



        /**
         * @test
         */
        public function testGetIndex() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php", "note" => "11"],
                ["name" => "Marc", "language" => "javascript", "note" => "15"],
                ["name" => "Emily", "language" => "python", "note" => "13"]
            ]);

            $key = $this->collection->get("0")->keys("php");

            $this->assertEquals(["language"], $key);
        }



        /**
         * @test
         */
        public function testGetAllIndexes() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php", "note" => "11"],
                ["name" => "Marc", "language" => "javascript", "note" => "15"],
                ["name" => "Emily", "language" => "python", "note" => "13"]
            ]);

            $keys = $this->collection->get("0")->keys();

            $this->assertEquals(["name", "language", "note"], $keys);
        }



        /**
         * @test
         */
        public function testIfIndexExist() : void
        {
            $this->collection = $this->getCollection();
            $this->datas = $this->collection
                ->set("username", "john")
                ->set("job", "dev");

            $exist = $this->collection->has("username");

            $this->assertNotFalse($exist);
        }



        /**
         * @test
         */
        public function testIfIndexNotExist() : void
        {
            $this->collection = $this->getCollection();
            $this->datas = $this->collection
                ->set("username", "john")
                ->set("job", "dev");

            $exist = $this->collection->has("lastname");

            $this->assertFalse($exist);
        }



        /**
         * @test
         */
        public function testUseObjetAsArray() : void
        {
            $this->collection = $this->getCollection();
            $this->datas["username"] = "john";

            $this->assertEquals("john", $this->datas["username"]);
        }



        /**
         * @test
         */
        public function testForeachOnObjet() : void
        {
            $this->collection = $this->getCollection(["john", "maria", "chris"]);
            
            $datas = [];
            foreach ($this->datas as $k => $v) {
                $datas[] = "$k = $v";
            }
            $datas = implode(", ", $datas);

            $this->assertEquals("0 = john, 1 = maria, 2 = chris", $datas);
        }



        /**
         * @test
         */
        public function testExtractDatas() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php"],
                ["name" => "Marc", "language" => "javascript"],
                ["name" => "Emily", "language" => "python"]
            ]);
            
            $datas = $this->collection->extract("language");
                
            $this->assertContains("php", $datas);
            $this->assertContains("python", $datas);
            $this->assertNotContains("html", $datas);
        }



        /**
         * @test
         */
        public function testExtractDataAndAddIndexAndValueInNewArray() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php"],
                ["name" => "Marc", "language" => "javascript"],
                ["name" => "Emily", "language" => "python"]
            ]);
            
            $datas = $this->collection->lists("name", "language");
            
            $this->assertArrayHasKey("Jean", $datas);
            $this->assertContains("php", $datas);
            $this->assertArrayNotHasKey("Bob", $datas);
            $this->assertNotContains("html", $datas);
        }



        /**
         * @test
         */
        public function testImplodeDatas() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php"],
                ["name" => "Marc", "language" => "javascript"],
                ["name" => "Emily", "language" => "python"]
            ]);
            
            $datas = $this->collection->extract("language")->join(", ");
                
            $this->assertEquals("php, javascript, python", $datas);
        }



        /**
         * @test
         */
        public function testExtractMinimumValue() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $syntaxOne = $this->collection->extract("note")->min();
            $syntaxTwo = $this->collection->min("note");

            $this->assertEquals(11, $syntaxOne);
            $this->assertEquals(11, $syntaxTwo);
        }



        /**
         * @test
         */
        public function testExtractMaximumValue() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $syntaxOne = $this->collection->extract("note")->max();
            $syntaxTwo = $this->collection->max("note");

            $this->assertEquals(15, $syntaxOne);
            $this->assertEquals(15, $syntaxTwo);
        }



        /**
         * @test
         */
        public function testSortAnArrayAlphabetically() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $syntaxOne = $this->collection->extract("name")->sort();
            $syntaxTwo = $this->collection->sort("name");

            $this->assertEquals("Emily, Jean, Marc", $syntaxOne);
            $this->assertEquals("Emily, Jean, Marc", $syntaxTwo);
        }



        /**
         * @test
         */
        public function testSortAnArrayByreverseAlphabeticalOrder() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $syntaxOne = $this->collection->extract("name")->rsort();
            $syntaxTwo = $this->collection->rsort("name");

            $this->assertEquals("Marc, Jean, Emily", $syntaxOne);
            $this->assertEquals("Marc, Jean, Emily", $syntaxTwo);
        }
    }

