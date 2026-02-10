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
            <header class=\"navbar\">
                <nav class=\"container-fluid text-center\">
                    <ul class=\"d-flex gap-3 navbar-nav flex-row align-items-center\">
                        <li class=\"nav-item\">
                            <a class=\"navbar-brand\" href=\"{$this->dots}/# \">
                                <img src=\"{$this->dots}/recursos/img/VEX_logo.png\" alt=\"\" class=\"img-fluid mb-3\">
                            </a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link active border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/# \">Browse Games</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/# \">Upload Game</a>
                        </li>
                    </ul>
                    <!-- ELIMINAR LOS BOTONES SI ESTA INICIADA LA SESION Y PONER UN BOTON PARA CERRARLA-->
                    <ul class=\"d-flex gap-3 text-light align-items-center navbar-nav flex-row\">
                        <li class=\"nav-item\">
                            <a class=\"nav-link border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/# \">Login</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"nav-link border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/# \">Register</a>
                        </li>
                        <li class=\"nav-item\" hidden>
                            <a class=\"nav-link border border-5 border-black rounded-pill bg-white p-2\" aria-current=\"page\" href=\"{$this->dots}/# \">Log Out</a>
                        </li>
                        <li class=\"nav-item\">
                            <a class=\"navbar-brand\" href=\"#\">
                                <img src=\"{$this->dots}/recursos/img/sinperfil.webp\" alt=\"\" class=\"img-fluid rounded-circle border border-black border-3\" style=\"width: 8rem; height: 8rem;\">
                            </a>
                        </li>
                    </ul>
                </nav>
            </header>
        ";
    }
}
