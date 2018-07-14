<?php

/* login-layout.twig */
class __TwigTemplate_ac89c21a69a9d3af01ad9f13b89769ffd6143c15ca1c587a51c8d4c325543eaf extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head lang=\"en\">
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title> Login Page </title>

    <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\"/>
    <link rel=\"stylesheet\" href=\"css/font-awesome.min.css\" type=\"text/css\"/>
    <link rel=\"stylesheet\" href=\"css/custom.css\" type=\"text/css\">

    <script src=\"js/jquery-2.1.1.min.js\"></script>
    <script src=\"js/bootstrap.min.js\"> </script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src=\"js/html5shiv.min.js\"></script>
    <script src=\"js/respond.min.js\"></script>
    <![endif]-->
</head>

<body>

<div class=\"container\">
    ";
        // line 26
        $this->displayBlock('content', $context, $blocks);
        // line 28
        echo "</div>


</body>
</html>";
    }

    // line 26
    public function block_content($context, array $blocks = array())
    {
        // line 27
        echo "    ";
    }

    public function getTemplateName()
    {
        return "login-layout.twig";
    }

    public function getDebugInfo()
    {
        return array (  64 => 27,  61 => 26,  53 => 28,  51 => 26,  24 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<head lang=\"en\">
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title> Login Page </title>

    <link rel=\"stylesheet\" href=\"css/bootstrap.min.css\"/>
    <link rel=\"stylesheet\" href=\"css/font-awesome.min.css\" type=\"text/css\"/>
    <link rel=\"stylesheet\" href=\"css/custom.css\" type=\"text/css\">

    <script src=\"js/jquery-2.1.1.min.js\"></script>
    <script src=\"js/bootstrap.min.js\"> </script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src=\"js/html5shiv.min.js\"></script>
    <script src=\"js/respond.min.js\"></script>
    <![endif]-->
</head>

<body>

<div class=\"container\">
    {% block content %}
    {% endblock %}
</div>


</body>
</html>", "login-layout.twig", "/home/vagrant/work/tab/templates/login-layout.twig");
    }
}
