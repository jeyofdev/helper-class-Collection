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

            $this->assertEquals("language", $key);
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
        public function testGetFirstIndex() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php", "note" => "11"],
                ["name" => "Marc", "language" => "javascript", "note" => "15"],
                ["name" => "Emily", "language" => "python", "note" => "13"]
            ]);

            $key = $this->collection->get("0")->firstKey();

            $this->assertEquals("name", $key);
        }



        /**
         * @test
         */
        public function testGetLastIndex() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "language" => "php", "note" => "11"],
                ["name" => "Marc", "language" => "javascript", "note" => "15"],
                ["name" => "Emily", "language" => "python", "note" => "13"]
            ]);

            $key = $this->collection->get("0")->lastKey();

            $this->assertEquals("note", $key);
        }



        /**
         * @test
         */
        public function testCheckIfIndexExist() : void
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
        public function testCheckIfValueExist() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $true = $this->collection->extract("name")->exist("Jean");
            $false = $this->collection->extract("name")->exist("Maria");

            $this->assertNotFalse($true);
            $this->assertFalse($false);
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
        public function testExtractPortionOfArray() : void
        {
            $this->collection = $this->getCollection([
                "php", "javascript", "python", "html", "css", "java"
            ]);
            
            $testOne = $this->collection->extractPart(2)->getDatas();
            $testTwo = $this->collection->extractPart(-3, 2)->getDatas();
            $testThree = $this->collection->extractPart(0, 3)->getDatas();
            
            $this->assertEquals(["python", "html", "css", "java"], $testOne);
            $this->assertEquals(["html", "css"], $testTwo);
            $this->assertEquals(["php", "javascript", "python"], $testThree);
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



        /**
         * @test
         */
        public function testDeleteIndex() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $datas = $this->collection->extract("name")->delete("1", "2")->getDatas();

            $this->assertEquals(["Jean"], $datas);
        }



        /**
         * @test
         */
        public function testDeleteFirstIndex() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $datas = $this->collection->extract("name")->deleteFirst()->getDatas();

            $this->assertEquals(["Marc", "Emily"], $datas);
        }



        /**
         * @test
         */
        public function testDeleteLastIndex() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $datas = $this->collection->extract("name")->deleteLast()->getDatas();

            $this->assertEquals(["Jean", "Marc"], $datas);
        }



        /**
         * @test
         */
        public function testEmptyArray() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $datas = $this->collection->extract("name")->empty()->getDatas();

            $this->assertEmpty($datas);
        }



        /**
         * @test
         */
        public function testReverseIndex() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $datas = $this->collection->extract("name")->reverse()->getDatas();

            $this->assertEquals(["Emily", "Marc", "Jean"], $datas);
        }



        /**
         * @test
         */
        public function testAddElementsToAnArray() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);
            
            $start = $this->collection->extract("name")->add("start", "John", "Maria")->getDatas();
            $end = $this->collection->extract("name")->add("end", "John", "Maria")->getDatas();

            $this->assertEquals(["John", "Maria", "Jean", "Marc", "Emily"], $start);
            $this->assertEquals(["Jean", "Marc", "Emily", "John", "Maria"], $end);
        }



        /**
         * @test
         */
        public function testExecuteFunctionOnValuesOfArray() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);

            $datas = $this->collection->extract("name");
            
            $names = $this->collection->extract("name")->map(function ($datas) {
                return strtoupper($datas);
            })->getDatas();

            $this->assertEquals(["JEAN", "MARC", "EMILY"], $names);
        }



        /**
         * @test
         */
        public function testFilterElementsOfArray() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 8],
                ["name" => "Emily", "note" => 13]
            ]);

            $datas = $this->collection->extract("note");
            
            $average = $this->collection->extract("note")->filter(function ($datas) {
                return ($datas >= 10) ? $datas : null;
            })->getDatas();

            $this->assertEquals(["0" => 11, "2" => 13], $average);
        }



        /**
         * @test
         */
        public function testCountElementsOfArray() : void
        {
            $this->collection = $this->getCollection([
                ["name" => "Jean", "note" => 11],
                ["name" => "Marc", "note" => 15],
                ["name" => "Emily", "note" => 13]
            ]);

            $count = $this->collection->extract("name")->count();

            $this->assertEquals(3, $count);
        }
    }

