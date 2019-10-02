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
        public function testGetValueOfAnIndex() : void
        {
            $this->collection = $this->getCollection();
            $this->datas = $this->collection
                ->set("username", "john")
                ->set("job", "dev");

            $username = $this->collection->get('job');

            $this->assertEquals("dev", $username);
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
    }

