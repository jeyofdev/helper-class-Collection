<?php

    namespace jeyofdev\Helper\ManipulateArray;


    use ArrayAccess;
    use Exception;


    /**
     * @author jeyofdev <jgregoire.pro@gmail.com>
     */
    class Collection
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
    }