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
    }

