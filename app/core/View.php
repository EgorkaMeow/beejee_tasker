<?php
    class View
    {
        public function generate(string $content, $data = [])
        {
            if(is_array($data)) {
                extract($data);
            }

            include __DIR__ . '/../views/' . $content;
        }
    }