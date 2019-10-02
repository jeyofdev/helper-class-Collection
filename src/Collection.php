<?php

    namespace jeyofdev\Helper\ManipulateArray;


    use ArrayAccess;
    use Exception;


    /**
     * @author jeyofdev <jgregoire.pro@gmail.com>
     */
    class Collection implements ArrayAccess
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
    }