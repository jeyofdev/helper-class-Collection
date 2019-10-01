<?php

    namespace jeyofdev\Helper\ManipulateArray;


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
    }