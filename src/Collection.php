<?php

    namespace jeyofdev\Helper\ManipulateArray;


    use ArrayAccess;
    use ArrayIterator;
    use Exception;
    use IteratorAggregate;


    /**
     * @author jeyofdev <jgregoire.pro@gmail.com>
     */
    class Collection implements ArrayAccess, IteratorAggregate
    {
        /**
         * @var array
         */
        private $datas;



        /**
         * @param array $datas
         */
        public function __construct (array $datas)
        {
            $this->datas = $datas;
        }



        /**
         * Get the value of a given index
         *
         * @return string|null
         */
        public function get (string $key) : ?string
        {
            if ($this->has($key)) {
                return $this->datas[$key];
            } else {
                throw new Exception("The key '$key' does not exist in the array");
            }
        }



        /**
         * Set the value of a given index
         * 
         * @param mixed $value
         * @return self
         */
        public function set (string $key, $value) : self
        {
            $this->datas[$key] = $value;
            return $this;
        }



        /**
         * Get the contents of an array
         *
         * @return array
         */
        public function getDatas () : array
        {
            return $this->datas;
        }




        /**
         * Checks if the given index exists
         *
         * @return boolean
         */
        public function has(string $key) : bool
        {
            return array_key_exists($key, $this->datas);
        }



        /**
         * Extract data from an array and add the index and its value in a new array
         *
         * @param mixed $key
         * @param mixed $value
         * @return Collection
         */
        public function lists($key, $value) : Collection
        {
            $results = [];

            foreach($this->datas as $item){
                $results[$item[$key]] = $item[$value];
            }

            return new Collection($results);
        }



        /**
         * Extract data from an array and add it in a new array
         *
         * @param mixed $key
         * @return Collection
         */
        public function extract($key) : Collection
        {
            $results = [];

            foreach($this->datas as $item){
                $results[] = $item[$key];
            }

            return new Collection($results);
        }



        /**
         * Join array values in a string
         *
         * @return string|null
         */
        public function join(string $glue) : ?string
        {
            return implode($glue, $this->datas);
        }



        /**
         * Extract the minimum value from an array
         *
         * @param mixed $key
         * @return integer|null
         */
        public function min($key = false) : ?int
        {
            if($key){
                return $this->extract($key)->min();
            } 
            else {
                return min($this->datas);
            }
        }



        /**
         * Extract the maximum value from an array
         *
         * @param mixed $key
         * @return integer|null
         */
        public function max($key = false) : ?int
        {
            if($key){
                return $this->extract($key)->max();
            } 
            else {
                return max($this->datas);
            }
        }



        /**
         * Check if an offset exists
         *
         * @param mixed $offset
         * @return bool
         */
        public function offsetExists($offset) : bool
        {
            return $this->has($offset);
        }



        /**
         * Get an offset
         *
         * @param mixed $offset
         * @return mixed
         */
        public function offsetGet($offset)
        {
            return $this->get($offset);
        }



        /**
         * Assign a value to the specified offset
         *
         * @param mixed $offset
         * @param mixed $value
         * @return void
         */
        public function offsetSet($offset, $value) : void
        {
            $this->set($offset, $value);
        }



        /**
         * Unset an offset
         *
         * @param mixed $offset
         * @return void
         */
        public function offsetUnset($offset) : void
        {
            if($this->has($offset)){
                unset($this->datas[$offset]);
            }
        }



        /**
         * Create an external Iterator
         *
         * @return ArrayIterator
         */
        public function getIterator() : ArrayIterator
        {
            return new ArrayIterator($this->datas);
        }
    }