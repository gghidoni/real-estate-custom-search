<?php 

//======================================= CREO LO SHORTCODE PER RICHIAMARE IL FORM========================================================

function novastart_form_setup() {
    add_shortcode( 'novastart_search_form', 'novastart_search_form' );
}
add_action( 'init', 'novastart_form_setup' );


// FUNZIONE SEARCH FORM

function novastart_search_form( $args ){

    $args = array( 'hide_empty' => false );
    $stat_terms = get_terms( 'prop_stato', $args );
    if( is_array( $stat_terms ) ){
        // $select_stat = '<div class="multi-select-box">';
        $select_stat .= '<div class="select-box">';
        $select_stat .= '<div class="select-box__label"><p>Stato proprietà</p></div>';
        $select_stat .= '<div class="select-box__sel-box">
                                <p id="selected-value"></p>
                                <span class="down-arrow"><img src="'. get_template_directory_uri() .'/img/icons/triangle-dwn.svg"></span>
                            </div>';
        $select_stat .= '</div>';
        $select_stat .= '<div class="select-box__list">';
        foreach ( $stat_terms as $term ) {
            $select_stat .= '<span><input class="checkbox" type="checkbox" name="stat[]" value="'. $term->slug .'" id="' . $term->slug . '"><label for="'. $term->slug .'" class="task">'. $term->name .'</label><span>';
        }
        // $select_stat .= '</div>';
        $select_stat .= '</div>' . "\n";
    }

    // ==================================== DINAMICIZIAMO IL SELECT-CHECKBOX PROP_TIPO (TASSONOMIA) =========================================================

    $args = array( 'hide_empty' => false );
    $tipo_terms = get_terms( 'prop_tipo', $args );
    if( is_array( $tipo_terms ) ){
        // $select_tipo = '<div class="multi-select-box">';
        $select_tipo .= '<div class="select-box">';
        $select_tipo .= '<div class="select-box__label"><p>Tipologia</p></div>';
        $select_tipo .= '<div class="select-box__sel-box">
                                <p id="selected-value"></p>
                                <span class="down-arrow"><img src="'. get_template_directory_uri() .'/img/icons/triangle-dwn.svg"></span>
                            </div>';
        $select_tipo .= '</div>';
        $select_tipo .= '<div class="select-box__list">';
        foreach ( $tipo_terms as $term ) {
            $select_tipo .= '<span><input class="checkbox" type="checkbox" name="tipo[]" value="'. $term->slug .'" id="' . $term->slug . '"><label for="'. $term->slug .'" class="task">'. $term->name .'</label></span>';
        }
        // $select_tipo .= '</div>';
        $select_tipo .= '</div>' . "\n";
    }



    // ==================================== DINAMICIZIAMO IL SELECT-CHECKBOX PROP_CARATT (TASSONOMIA) =========================================================

    $args = array( 'hide_empty' => false );
    $caratt_terms = get_terms( 'prop_caratt', $args );
    if( is_array( $caratt_terms ) ){
        // $select_caratt = '<div class="multi-select-box">';
        $select_caratt .= '<div class="select-box">';
        $select_caratt .= '<div class="select-box__label"><p>Altre Caratteristiche</p></div>';
        $select_caratt .= '<div class="select-box__sel-box">
                                <p id="selected-value"></p>
                                <span class="down-arrow"><img src="'. get_template_directory_uri() .'/img/icons/triangle-dwn.svg"></span>
                            </div>';
        $select_caratt .= '</div>';
        $select_caratt .= '<div class="select-box__list">';
        foreach ( $caratt_terms as $term ) {
            $select_caratt .= '<span><input class="checkbox" type="checkbox" name="caratt[]" value="'. $term->slug .'" id="' . $term->slug . '"><label for="'. $term->slug .'" class="task">'. $term->name .'</label></span>';
        }
        // $select_caratt .= '</div>';
        $select_caratt .= '</div>' . "\n";
    }




// ==================================== DINAMICIZIAMO IL SELECT-CHECKBOX PROP_POSIZ (TASSONOMIA) CON GERARCHIA REGIONI =========================================================


function get_terms_hierarchical($terms, $output_pos = '', $parent_id = 0, $level = 0) {
    //Out Template
    $outputTemplate = '<span><input class="checkbox" type="checkbox" name="posiz[]" value="%SLUG%" id="%SLUG%"><label for="%SLUG%" class="task level-%PADDING%">%PADDING2% %NAME%</label></span>';

    foreach ($terms as $term) {
        if ($parent_id == $term->parent) {
            //Replacing the template variables
            $itemOutput = str_replace('%ID%', $term->term_id, $outputTemplate);
            $itemOutput = str_replace('%PADDING%', str_pad('', $level*1, 'x'), $itemOutput);
            $itemOutput = str_replace('%PADDING2%', str_pad('', $level*1, '-'), $itemOutput);
            $itemOutput = str_replace('%NAME%', $term->name, $itemOutput);
            $itemOutput = str_replace('%SLUG%', $term->slug, $itemOutput);

            $output_pos .= $itemOutput;
            $output_pos = get_terms_hierarchical($terms, $output_pos, $term->term_id, $level + 1);
        }
    }
    return $output_pos;
}

$terms = get_terms('prop_posiz', array('hide_empty' => false));
$output_pos = get_terms_hierarchical($terms);

$select_posiz .= '<div class="select-box">';
$select_posiz .= '<div class="select-box__label"><p>Location</p></div>';
$select_posiz .= '<div class="select-box__sel-box">
                        <p id="selected-value"></p>
                        <span class="down-arrow"><img src="'. get_template_directory_uri() .'/img/icons/triangle-dwn.svg"></span>
                    </div>';
$select_posiz .= '</div>';
$select_posiz .= '<div class="select-box__list">';
$select_posiz .= $output_pos;

$select_posiz .= '</div>' . "\n";






    //======================================= STAMPIAMO IL FORM=======================================================================

    $output = '<div class="form-ajax fade-left delay-4">';
    $output .= '<div class="multi-select-box stato">' . $select_stat . '</div>';
    $output .= '<div class="multi-select-box tipo">' . $select_tipo . '</div>';
    $output .= '<div class="multi-select-box posiz">' . $select_posiz . '</div>';
    $output .= '<div class="multi-select-box p-min">
                    <div class="select-box">
                        <div class="select-box__label"><p>Prezzo min:</p></div>
                        <div class="select-box__sel-box">
                            <p id="selected-value"></p>
                            <span class="down-arrow"><img src="'. get_template_directory_uri() .'/img/icons/triangle-dwn.svg"></span>
                        </div>
                    </div>
                    <div class="select-box__list one-check">
                        <span><input class="checkbox" type="checkbox" name="prezzo_min[]" value="10000" id="p-min-1"><label for="p-min-1" class="task">10.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_min[]" value="25000" id="p-min-2"><label for="p-min-2" class="task">25.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_min[]" value="100000" id="p-min-3"><label for="p-min-3" class="task">100.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_min[]" value="250000" id="p-min-4"><label for="p-min-4" class="task">250.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_min[]" value="500000" id="p-min-5"><label for="p-min-5" class="task">500.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_min[]" value="1000000" id="p-min-6"><label for="p-min-6" class="task">1.000.000€</label></span>
                    </div>
                </div>';
    $output .= '<div class="multi-select-box p-max">
                    <div class="select-box">
                        <div class="select-box__label"><p>Prezzo max:</p></div>
                        <div class="select-box__sel-box">
                            <p id="selected-value"></p>
                            <span class="down-arrow"><img src="'. get_template_directory_uri() .'/img/icons/triangle-dwn.svg"></span>
                        </div>
                    </div>
                    <div class="select-box__list one-check">
                        <span><input class="checkbox" type="checkbox" name="prezzo_max[]" value="100000" id="p-max-1"><label for="p-max-1" class="task">100.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_max[]" value="250000" id="p-max-2"><label for="p-max-2" class="task">250.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_max[]" value="500000" id="p-max-3"><label for="p-max-3" class="task">500.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_max[]" value="1000000" id="p-max-4"><label for="p-max-4" class="task">1.000.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_max[]" value="5000000" id="p-max-5"><label for="p-max-5" class="task">5.000.000 €</label></span>
                        <span><input class="checkbox" type="checkbox" name="prezzo_max[]" value="10000000" id="p-max-6"><label for="p-max-6" class="task">10.000.000 €</label></span>
                    </div>
                </div>';
    $output .= '<div class="multi-select-box d-min">
                    <div class="select-box">
                        <div class="select-box__label"><p>Dim min:</p></div>
                        <div class="select-box__sel-box">
                            <p id="selected-value"></p>
                            <span class="down-arrow"><img src="'. get_template_directory_uri() .'/img/icons/triangle-dwn.svg"></span>
                        </div>
                    </div>
                    <div class="select-box__list one-check">
                        <span><input class="checkbox" type="checkbox" name="dim_min[]" value="50" id="d-min-1"><label for="d-min-1" class="task">50 mq</label></span>
                        <span><input class="checkbox" type="checkbox" name="dim_min[]" value="100" id="d-min-2"><label for="d-min-2" class="task">100 mq</label></span>
                        <span><input class="checkbox" type="checkbox" name="dim_min[]" value="250" id="d-min-3"><label for="d-min-3" class="task">250 mq</label></span>
                        <span><input class="checkbox" type="checkbox" name="dim_min[]" value="300" id="d-min-4"><label for="d-min-4" class="task">300 mq</label></span>
                        <span><input class="checkbox" type="checkbox" name="dim_min[]" value="400" id="d-min-5"><label for="d-min-5" class="task">400 mq</label></span>
                    </div>
                </div>';
    $output .= '<div class="multi-select-box d-max">
                    <div class="select-box">
                        <div class="select-box__label"><p>Dim max:</p></div>
                        <div class="select-box__sel-box">
                            <p id="selected-value"></p>
                            <span class="down-arrow"><img src="'. get_template_directory_uri() .'/img/icons/triangle-dwn.svg"></span>
                        </div>
                    </div>
                    <div class="select-box__list one-check">
                        <span><input class="checkbox" type="checkbox" name="dim_max[]" value="100" id="d-max-1"><label for="d-max-1" class="task">100 mq</label></span>
                        <span><input class="checkbox" type="checkbox" name="dim_max[]" value="200" id="d-max-2"><label for="d-max-2" class="task">200 mq</label></span>
                        <span><input class="checkbox" type="checkbox" name="dim_max[]" value="300" id="d-max-3"><label for="d-max-3" class="task">300 mq</label></span>
                        <span><input class="checkbox" type="checkbox" name="dim_max[]" value="400" id="d-max-4"><label for="d-max-4" class="task">400 mq</label></span>
                        <span><input class="checkbox" type="checkbox" name="dim_max[]" value="500" id="d-max-5"><label for="d-max-5" class="task">500 mq</label></span>
                    </div>
                </div>';
            $output .= '<div class="multi-select-box--sm">
            <div class="select-box__label--sm"><label>Min camere:</label></div>
            <div class="select-box__sel-box--sm"><input class="sel-click" type="number" name="camere_min" value="0"></div>
        </div>';
    $output .= '<div class="multi-select-box--sm">
                     <div class="select-box__label--sm"><label>Min bagni:</label></div>
                    <div class="select-box__sel-box--sm"><input class="sel-click" type="number" name="bagni_min" value="0"></div>
                </div>';
    $output .= '<div class="multi-select-box--sm">
                    <div class="select-box__label--sm"><label>Min garages:</label></div>
                    <div class="select-box__sel-box--sm"><input class="sel-click" type="number" name="garages_min" value="0"></div>
                </div>';
    $output .= '<div class="multi-select-box caratt">' . $select_caratt . '</div>';
    $output .= '<div class="button-ajax" id="btn-search"><p>Cerca</p><img src="'. get_template_directory_uri() .'/img/icons/ricerca-casa.svg"></div>';
    $output .= '</div>';

    return $output;
}

/* !   ------------------------------------------------------------------------------------------------------    */






function novastart_ajax_script(){
    wp_enqueue_script( 'novastart_ajax', get_stylesheet_directory_uri(). '/ajax/js/ajax.js',  array('jquery'), microtime(), true );
    wp_localize_script( 'novastart_ajax', 'novastart_obj',
     array(
        'admin_url' => admin_url('admin-ajax.php' )
    ) );
}
add_action( 'wp_enqueue_scripts', 'novastart_ajax_script' );





// FUNZIONE RICERCA AJAX

function get_novastart_search(){

    $args = array(
        'post_type' => 'proprieta',
        'tax_query' => array(),
     
    );

 

    $args['meta_query'][] = array(
        'key'     => 'prop_camere',
        'value'   =>  $_POST['camere_min'],
        'type'    => 'numeric',
        'compare' => '>=',
    );
    $args['meta_query'][] = array(
        'key'     => 'prop_bagni',
        'value'   =>  $_POST['bagni_min'],
        'type'    => 'numeric',
        'compare' => '>=',
    );
    $args['meta_query'][] = array(
        'key'     => 'prop_garages',
        'value'   =>  $_POST['garages_min'],
        'type'    => 'numeric',
        'compare' => '>=',
    );

   

  
        

    $args['meta_query'][] = array(
        'key'     => 'prop_prezzo',
        'value'   =>  array($_POST['prezzo_min'][0], $_POST['prezzo_max'][0]),
        'type'    => 'numeric',
        'compare' => 'BETWEEN',
    );
 
    $args['meta_query'][] = array(
        'key'     => 'prop_dimensione',
        'value'   =>  array($_POST['dim_min'][0], $_POST['dim_max'][0]),
        'type'    => 'numeric',
        'compare' => 'BETWEEN',
    );



    if ( null != $_POST['tipo'] ) {

        $args['tax_query'][] = array(
            array(
            'taxonomy' => 'prop_tipo',
            'field' => 'slug',
            'terms' => $_POST['tipo']
            )
        );

    }

    if ( null != $_POST['stat'] ) {

        $args['tax_query'][] = array(
            array(
            'taxonomy' => 'prop_stato',
            'field' => 'slug',
            'terms' => $_POST['stat'],
            )
        );

    }

    if ( null != $_POST['caratt'] ) {

        $args['tax_query'][] = array(
            array(
            'taxonomy' => 'prop_caratt',
            'field' => 'slug',
            'terms' => $_POST['caratt']
            )
        );

    }

    if ( null != $_POST['posiz'] ) {

        $args['tax_query'][] = array(
            array(
            'taxonomy' => 'prop_posiz',
            'field' => 'slug',
            'terms' => $_POST['posiz']
            )
        );

    }

    if ( null != $_POST['regione'] ) {

        $args['tax_query'][] = array(
            array(
            'taxonomy' => 'prop_regione',
            'field' => 'slug',
            'terms' => $_POST['regione']
            )
        );

    }


    // the query
    $the_query = new WP_Query( $args ); ?>
    
    <?php if ( $the_query->have_posts() ) : ?>

        
    
        <!-- pagination here -->
        



    
        <!-- the loop -->
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>


            <div class="card-col">

                <div class="card fade-up delay-8">
                    <div class="card__stato">
                        <span>
                            <?php   // Get terms for post
                            $terms = get_the_terms( $post->ID , 'prop_stato' );
                            // Loop over each item since it's an array
                            if ( $terms != null ){
                            foreach( $terms as $term ) {
                                $term_link = get_term_link( $term, 'prop_stato' );
                                // Print the name and URL
                                echo  $term->name;
                                // Get rid of the other data stored in the object, since it's not needed
                                unset($term); } 
                            } ?>
                        </span> 
                    </div>
                    <div class="card__id">
                    <span><p>Rif.</p><?php the_field('prop_id') ?>
                    </div>
                    <div class="card__img">
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('novastart_card', array( 'class' => 'img-fluid', 'alt' => get_the_title() )) ?>
                        </a>
                    </div>
                    <div class="card__text">
                        <div class="card__text__info">
                            <div class="card__text__info__sm-box">
                                <?php if(get_field('prop_camere')){ ?>
                                <div class="card__text__info__sm">
                                    <div class="card__text__info__sm__icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/bed.svg" alt="bedroom"></div>
                                    <div class="card__text__info__sm__cf"><span><?php the_field('prop_camere') ?></span></div>
                                </div>
                                <?php } ?>
                                <?php if(get_field('prop_bagni')){ ?>
                                <div class="card__text__info__sm">
                                    <div class="card__text__info__sm__icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/bath.svg" alt="bathorrom"></div>
                                    <div class="card__text__info__sm__cf"><span><?php the_field('prop_bagni') ?></span></div>
                                </div>
                                <?php } ?>
                                <?php if(get_field('prop_garages')){ ?>
                                <div class="card__text__info__sm">
                                    <div class="card__text__info__sm__icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/garage.svg" alt="garage"></div>
                                    <div class="card__text__info__sm__cf"><span><?php the_field('prop_garages') ?></span></div>
                                </div>
                                <?php } ?>
                                <?php if(get_field('prop_dimensione')){ ?>
                                <div class="card__text__info__sm">
                                    <div class="card__text__info__sm__icon"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/mq.svg" alt="dimension"></div>
                                    <div class="card__text__info__sm__cf"><span><?php the_field('prop_dimensione') ?></span></div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="card__text__info__lg">
                                <div class="card__text__info__lg__price"><span><?php the_field('prop_prezzo') ?></span><p>&#128</p></div>
                            </div>
                        </div>
                        <div class="card__text__descript">
                            <div class="card__text__descript__title"><a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a></div>
                            <div class="card__text__descript__type">
                                <?php   // Get terms for post
                                $terms = get_the_terms( $post->ID , 'prop_tipo' );
                                // Loop over each item since it's an array
                                if ( $terms != null ){
                    
                                foreach( $terms as $term ) {
                                    $term_link = get_term_link( $term, 'prop_tipo' );
                                    // Print the name and URL
                                    echo '<span><img src="'. get_template_directory_uri() .'/img/icons/dot.svg"><a href="' . $term_link . '">' . $term->name . '</a></span>';
                                    // Get rid of the other data stored in the object, since it's not needed
                                    unset($term); } 
                                } 
                                
                                ?>
                            </div>
                            <div class="card__text__descript__excerpt"><?php the_excerpt(); ?></div>
                            
                        </div>
                        <div class="card__text__posiz">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/icons/location.svg" alt="location">
                            <span>
                                <?php   // Get terms for post
                                $terms = get_the_terms( $post->ID , 'prop_posiz' );
                                // Loop over each item since it's an array
                                if ( $terms != null ){
                                    echo "";
                                foreach( $terms as $term ) {
                                    $term_link = get_term_link( $term, 'prop_posiz' );
                                    // Print the name and URL
                                    echo  $term->name;
                                    // Get rid of the other data stored in the object, since it's not needed
                                    unset($term); } 
                                } ?>
                            </span>
                            
                            
                        </div>
                    </div>
                </div>


            </div>
            
            
            
            
        <?php endwhile; ?>
        <!-- end of the loop -->
    
        <!-- pagination here -->
    
        <?php wp_reset_postdata(); ?>
    
    <?php else : ?>
        <p class="sorry-msg"><?php _e( 'Spiacenti, non ci sono proprietà che soddisfano i tuoi criteri di ricerca.' ); ?></p>

    <?php endif; 

    exit;

}

add_action( 'wp_ajax_get_novastart_search' , 'get_novastart_search' );
add_action('wp_ajax_nopriv_get_novastart_search' , 'get_novastart_search');


