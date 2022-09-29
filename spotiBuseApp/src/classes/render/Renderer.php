<?php
    namespace iutnc\spotibuse\render;
    interface Renderer{
        
        const COMPACT = 1;
        const LONG = 0;

        public function render(int $selector): string;
    } 