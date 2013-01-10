
        <?php 
            $t_aClasses = array();
            for ($i = 1; $i <= 10; $i++)
            {
                $t_aClasses[$i] = 'tag'.$i;
            }
            
            $t_aTerms = array('web development ware', 'web development herts', 'website development', 'website design', 'website design herts', 'website design hertfordshire', 'HTML email campaigns', 'web application development', 'wordpress theme development', 'cheap websites', 'small business websites', 'website design essex', 'website development clacton', 'php development', 'SEO development','search engine optimisation services', 'html development', 'css development', 'website development ware','logo design ware', 'custom logo design','logo design herts', 'bespoke website design', 'HTML5 development', 'web based i-phone apps', 'professional website developers', 'pro website design','pro website developers','print design ware','stationary design herts');
            
            for ($i = 1; $i <= 5; $i++)
            {
                $t_iClassKey = mt_rand(1,10);
                $t_iTermKey = mt_rand(0,29);
                echo '<h4 class="'.$t_aClasses[$t_iClassKey].'">'.$t_aTerms[$t_iTermKey].'</h4>';
            }
        
        ?>
