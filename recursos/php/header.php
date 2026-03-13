<?php
class Header
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
            <header class=\"navbar navbar-expand-lg luckiestGuyFontFamily\">
                <div class=\"container-fluid\">
                    <a class=\"navbar-brand\" href=\"{$this->dots}/index.php\">
                        <img src=\"{$this->dots}/recursos/img/VEX_logo.png\" alt=\"\" class=\"img-fluid mb-3\">
                    </a>
                    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                        <span class=\"navbar-toggler-icon\"></span>
                    </button>

                    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
                        <ul class=\"navbar-nav me-auto mb-2 mb-lg-0 gap-2\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link active border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/Back/gamesPage.php\">Browse Games</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/Back/formGameRegister.php\">Upload Game</a>
                            </li>
                        </ul>

                        <!-- ELIMINAR LOS BOTONES SI ESTA INICIADA LA SESION Y PONER UN BOTON PARA CERRARLA -->
                        <ul class=\"navbar-nav ms-auto mb-2 mb-lg-0 gap-2 align-items-center\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/#\">Login</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/#\">Register</a>
                            </li>
                            <li class=\"nav-item\" hidden>
                                <a class=\"nav-link border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/#\">Log Out</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"navbar-brand\" href=\"#\">
                                    <img src=\"{$this->dots}/recursos/img/sinperfil.webp\" alt=\"\" class=\"img-fluid rounded-circle border border-black border-3\" style=\"width: 8rem; height: 8rem;\">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
        ";
    }
}
