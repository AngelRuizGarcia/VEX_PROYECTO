<?php
class Footer
{
    public function __construct(
        public $dots = ".."
    ) {}

    public function setDots($newDots){
        $this->dots = $newDots;
    }

    public function toHTML()
    {
        return "
            <footer class=\"container-fluid my-5 pt-5\">
                <div class=\"row text-center align-items-center\">
                    <div class=\"col-12 fs-3\">2026&copy; VEX. INDIE DEVELOPMENT PLATFORM</div>
                    <div class=\"col-12 pb-3\">
                        <a class=\"icon-link px-3\" href=\"{$this->dots}/# \"><i class=\"bi bi-twitter-x\"></i></a>
                        <a class=\"icon-link px-3\" href=\"{$this->dots}/# \"><i class=\"bi bi-instagram\"></i></a>
                        <a class=\"icon-link px-3\" href=\"{$this->dots}/# \"><i class=\"bi bi-youtube\"></i></a>
                        <a class=\"icon-link px-3\" href=\"{$this->dots}/# \"><i class=\"bi bi-discord\"></i></a>
                    </div>
                    <div class=\"col-12\">
                        <a class=\"link-offset-2 link-dark pe-3\" href=\"{$this->dots}Front/src/paginas/terms.html\">Terms</a>
                        <a class=\"link-offset-2 link-dark pe-3\" href=\"{$this->dots}Front/src/paginas/privacy.html\">Privacy</a>
                        <a class=\"link-offset-2 link-dark pe-3\" href=\"{$this->dots}Front/src/paginas/cookies.html\">Cookies</a>
                        <a class=\"link-offset-2 link-dark\" href=\"{$this->dots}Front/src/paginas/contactUs.php\">Contact us</a>
                    </div>
                </div>
            </footer>
        ";
    }
}
?>