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
        public $datas;



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
         * @return mixed
         */
        public function get (?string $key = null)
        {
            if (!is_null($key)) {
                $index = explode(".", $key);
                return $this->getValue($index, $this->datas);
            }

            return array_values($this->datas);
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
         * Get all indexes or a given index of an array
         *
         * @param string|null $value
         * @return mixed
         */
        public function keys (?string $value = null)
        {
            if (is_null($value)) {
                return array_keys($this->datas);
            }

            return array_search($value, $this->datas);
        }



        /**
         * Get the first index of an array
         *
         * @return string|null
         */
        public function firstKey () : ?string
        {
            return array_key_first($this->datas);
        }



        /**
         * Get the last index of an array
         *
         * @return string|null
         */
        public function lastKey () : ?string
        {
            return array_key_last($this->datas);
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
         * Check if a given value exists
         *
         * @param mixed $value
         * @return boolean
         */
        public function exist ($value) : bool
        {
            return in_array($value, $this->datas);
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
        public function join(string $glue, array $datas = []) : ?string
        {
            if (empty($datas)) {
                $datas = $this->datas;
            }

            return implode($glue, $datas);
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
            } else {
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
            } else {
                return max($this->datas);
            }
        }



        /**
         * Sort an array alphabetically
         *
         * @return string|null
         */
        public function sort($key = false) : ?string
        {
            if($key){
                $array = $this->extract($key)->getDatas();
            } else {
                $array = $this->datas;
            }
            sort($array);

            return $this->join(", ", $array);
        }



        /**
         * Sort an array by reverse alphabetical order
         *
         * @return string|null
         */
        public function rsort($key = false) : ?string
        {
            if($key){
                $array = $this->extract($key)->getDatas();
            } else {
                $array = $this->datas;
            }
            rsort($array);

            return $this->join(", ", $array);
        }



        /**
         * Delete a given index from an array
         *
         * @return array
         */
        public function delete (string ...$key) : array
        {
            foreach ($key as $v) {
                if ($this->has($v)) {
                    unset($this->datas[$v]);
                } else {
                    throw new Exception("The '$v' index does not exist in the array");
                }
            }

            return $this->datas;
        }



        /**
         * Delete the first index of an array
         *
         * @return array
         */
        public function deleteFirst () : array
        {
            array_shift($this->datas);
            return $this->datas;
        }



        /**
         * Delete the last index of an array
         *
         * @return array
         */
        public function deleteLast () : array
        {
            array_pop($this->datas);
            return $this->datas;
        }



        /**
         * Reverse the order of the elements of an array
         *
         * @return array
         */
        public function reverse () : array
        {
            return array_reverse($this->datas);
        }



        /**
         * Add elements to an array
         *
         * @return array
         */
        public function add (string $position, string ...$value) : array
        {
            if ($position === "start") {
                return array_merge($value, $this->datas);
            } else if ($position === "end") {
                return array_merge($this->datas, $value);
            } else {
                $paramsAllowed = implode(" or ", ["start", "end"]);
                throw new Exception("The value of the 1st parameter is not allowed. Its value is " . $paramsAllowed);
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



        /**
         * Get the value of a index
         *
         * @return void
         */
        private function getValue(array $indexes, $value)
        {
            $key = array_shift($indexes);

            if(empty($indexes)){
                if(!array_key_exists($key, $value)) {
                    throw new Exception("The key '$key' does not exist in the array");
                }
                if(is_array($value[$key])){
                    return new Collection($value[$key]);
                }
                else{
                    return $value[$key];
                }
            }
            else{
                return $this->getValue($indexes, $value[$key]);
            }
        }
    }