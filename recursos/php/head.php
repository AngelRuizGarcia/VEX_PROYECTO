<?php
class Head{
    public function __construct(
        public $title = "VEX",
        public $dots = ".."
    ){}

    public function setTitle($newTitle){
        $this->title = $newTitle;
    }

    public function setDots($newDots){
        $this->dots = $newDots;
    }

    public function toHTML(){
        return "
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>{$this->title}</title>
            <link rel=\"stylesheet\" href=\"{$this->dots}/recursos/bootstrap/css/bootstrap.css\">
            <link rel=\"stylesheet\" href=\"{$this->dots}/recursos/bootstrap/icons/bootstrap-icons.css\">
            <script src=\"{$this->dots}/recursos/bootstrap/js/bootstrap.js\"></script>
            <link rel=\"stylesheet\" href=\"{$this->dots}/recursos/css/fontStyle.css\">
        ";
    }
}

?>