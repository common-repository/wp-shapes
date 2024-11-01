<?php
/**
 * class - creates shorcodes
 * two shorcodes created
 *  shape  - give img id - based on that it created shape
 *  shape_img  - just give img id - it adds image, creates shape 
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'CSH_Shortcode' ) ) :

 class CSH_Shortcode {



    /**
     * use shortcode to add img, shape
     * e.g. - [shape id=57] -  id - is image id.
     * 
     * @since 1.0.0
     *
     * @uses self::csh_shortcodes_init  - add_shortcode hook
     * 
     * @param array $atts -  an associative array of attributes, 
     *                       or an empty string if no attributes are given
     * @param string $content - the enclosed content 
     *                          (if the shortcode is used in its enclosing form)
     * @param string $shortcode - the shortcode tag, useful for shared callback functions
     * 
     * @return - html code with img tag, 
     *           inline styles with shape-outside, float, shape-margin properties
     */
    public function shape( $atts = [], $content = 'null', $shortcode = '') {
        
    /**
     * array key values 
     * @key int id - image id - based on this get the image path
     * @key string url  - image url - shape can be given using image id or direct url
     * @key string float - float - left or right - default to left
     * @key string margin - set shape-margin
     * @key string width - widht of image - suffix with css units - px, em ..
     * @key string height - height of image - suffix with css units - px, em ..
     * @key string shape - declare image shape - ( not mandatory - default to img shape )
     *                      polygon, circle, eclipse, inset ..
     * @key boolean clip  - default false - dont clip the image,
     *                      if true of anything clip the image @uses shape value
     * 
     * @var int $img_id  - declare with shortcode attribute id to this variable
     * @var string $\float  - decalre with shortcode attribute float to this variable
     * @var string $margin  - declare with shortcode attribute margin value
     * @var string $url     - decalre with shortcode attribute url value
     * @var string $width  - declare with shortcode attribute width value
     * @var string $height  - declare with shortcode attribute height value
     * @var string $shape  - declare with shortcode attribute shape value
     * @var string $clip  - declare with shorcode attribute clip value - true or false
     * 
     * @var string $url_id  - get image url based on given img id
     * @var string $custom_shape  - css shape-outside value - here given image url
     *                       works well if it is a transparent image, svg
     * @var string $float_class  - if float given is right - add class csh-right - image flow to right
     *                     if left - add class csh-left - default one - img flow to left
     * @var string $clip_path  - if true clip the image by using $custom_shape
     * @var string $general_margin  - adds margin- left or right based on image float. value is $margin
     *                         in some images at corners shape-margin not works, this works
     */
        $a = shortcode_atts(
            array(
                'id' => '',
                'float' => 'left',
                'margin' => '1em',
                'width' => null,
                'height' => null,
                'class' => '',
                'shape' => '',
                'clip' => false,
            ), $atts, $shortcode );
            // use like -  '.$a["id"].'   
        
        $img_id = esc_attr( $a["id"] );
        $float = esc_attr( $a["float"] );
        $margin = esc_attr( $a["margin"] );
        $width = esc_attr( $a["width"] );
        $height = esc_attr( $a["height"] );
        $class = esc_attr( $a["class"] );
        $custom_shape = esc_attr( $a["shape"] );
        $clip = esc_attr( $a["clip"] );
        
        $url_id =  wp_get_attachment_url( $img_id );

        if( 'left' == $float) {
            $float_class = 'csh-left';
            $general_margin = 'margin-right';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
            $general_margin = 'margin-left';
        }

        
        /**
         * there is a problem if width, height pass in this way - with suffix for - svg images
         * return like this - <img width="1" height="1"  --  1 * 1 - its not displaying
         * instead added styles using style attributes
         * 
         * @see https://core.trac.wordpress.org/ticket/26256
         */
        // $array_size = array( $width, $height );

      
        $class .= " shape csh-image wp-image-$img_id";
        $class .= " $float_class";

        if ( '' == $custom_shape || null == $custom_shape ) {
            $shape_outside = "url($url_id)";
        } else {
            $shape_outside = $custom_shape;
        }

        if ( false == $clip ) {
            $clip_path = '';
        } else {
            $clip_path = $custom_shape;
        }

        
        /**
         * if width, height, clip-path not defined
         * then dont pass that null ( invalid ) values
         * 
         * @var string $add_width - if $width is not null then add $width to style attribute 
         * @var string $add_height - if $height is not null then add $height to style attribute 
         * @var string $add_clip_path - if $clip_path is not null then add $clip_path to style attribute 
         */
        if ( '' == $width || null == $width ) {
            $add_width = '' ;
        } else {
            $add_width = ' width: '.$width.'; ' ;
        }

        if ( '' == $height || null == $height ) {
            $add_height = '' ;
        } else {
            $add_height = ' height: '.$height.'; ' ;
        }

        if ( '' == $clip_path || null == $clip_path ) {
            $add_clip_path = '' ;
        } else {
            $add_clip_path = ' clip-path: '.$clip_path.'; ' ;
        }


        $array_attr = array(
            'class' => ' '.$class.' ',
            // 'style' => 'shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.' ',
            'style' =>  ' '.$add_width.' '.$add_height.'  shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.';  '.$general_margin.': '.$margin.'; '.$add_clip_path.' ',
        );


        $o = '';
        // $o .= ' '. wp_get_attachment_image( $img_id, $array_size, '', $array_attr ).' ';
        $o .= ' '. wp_get_attachment_image( esc_attr( $img_id ), '', '', $array_attr ).' '; 
        
        return $o;
    }



    /**
     * @alpha   - In Dev
     * 
     * use shortcode to add img, shape
     * e.g. - [shape id=57] -  id - is image id.
     * 
     * @since 1.0.0
     *
     * @uses self::csh_shortcodes_init  - add_shortcode hook
     * 
     * @param array $atts -  an associative array of attributes, 
     *                       or an empty string if no attributes are given
     * @param string $content - the enclosed content 
     *                          (if the shortcode is used in its enclosing form)
     * @param string $shortcode - the shortcode tag, useful for shared callback functions
     * 
     * @return - html code with img tag, 
     *           inline styles with shape-outside, float, shape-margin properties
     */
    public function shape_img( $atts = [], $content = 'null', $shortcode = '') {
        
    /**
     * array key values 
     * @key int id - image id - based on this get the image path
     * @key string url  - image url - shape can be given using image id or direct url
     * @key string float - float - left or right - default to left
     * @key string margin - set shape-margin
     * @key string width - widht of image - suffix with css units - px, em ..
     * @key string height - height of image - suffix with css units - px, em ..
     * @key string shape - declare image shape - ( not mandatory - default to img shape )
     *                      polygon, circle, eclipse, inset ..
     * @key boolean clip  - default false - dont clip the image,
     *                      if true of anything clip the image @uses shape value
     * 
     * @var int $img_id  - declare with shortcode attribute id to this variable
     * @var string $\float  - decalre with shortcode attribute float to this variable
     * @var string $margin  - declare with shortcode attribute margin value
     * @var string $url     - decalre with shortcode attribute url value
     * @var string $width  - declare with shortcode attribute width value
     * @var string $height  - declare with shortcode attribute height value
     * @var string $shape  - declare with shortcode attribute shape value
     * @var string $clip  - declare with shorcode attribute clip value - true or false
     * 
     * @var string $url_id  - get image url based on given img id
     * @var string $custom_shape  - css shape-outside value - here given image url
     *                       works well if it is a transparent image, svg
     * @var string $float_class  - if float given is right - add class csh-right - image flow to right
     *                     if left - add class csh-left - default one - img flow to left
     * @var string $clip_path  - if true clip the image by using $custom_shape
     * @var string $general_margin  - adds margin- left or right based on image float. value is $margin
     *                         in some images at corners shape-margin not works, this works
     */
        $a = shortcode_atts(
            array(
                'id' => '',
                'float' => 'left',
                'margin' => '1em',
                'width' => null,
                'height' => null,
                'class' => '',
                'shape' => '',
                'clip' => false,
            ), $atts, $shortcode );
            // use like -  '.$a["id"].'   
        
        $img_id = esc_attr( $a["id"] );
        $float = esc_attr( $a["float"] );
        $margin = esc_attr( $a["margin"] );
        $width = esc_attr( $a["width"] );
        $height = esc_attr( $a["height"] );
        $class = esc_attr( $a["class"] );
        $custom_shape = esc_attr( $a["shape"] );
        $clip = esc_attr( $a["clip"] );
        
        $url_id =  wp_get_attachment_url( $img_id );

        if( 'left' == $float) {
            $float_class = 'csh-left';
            $general_margin = 'margin-right';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
            $general_margin = 'margin-left';
        }

        
        /**
         * there is a problem if width, height pass in this way - with suffix for - svg images
         * return like this - <img width="1" height="1"  --  1 * 1 - its not displaying
         * instead added styles using style attributes
         * 
         * @see https://core.trac.wordpress.org/ticket/26256
         */
        // $array_size = array( $width, $height );

      
        $class .= " shape csh-image wp-image-$img_id";
        $class .= " $float_class";

        if ( '' == $custom_shape || null == $custom_shape ) {
            $shape_outside = "url($url_id)";
        } else {
            $shape_outside = $custom_shape;
        }

        if ( false == $clip ) {
            $clip_path = '';
        } else {
            $clip_path = $custom_shape;
        }

        
        /**
         * if width, height, clip-path not defined
         * then dont pass that null ( invalid ) values
         * 
         * @var string $add_width - if $width is not null then add $width to style attribute 
         * @var string $add_height - if $height is not null then add $height to style attribute 
         * @var string $add_clip_path - if $clip_path is not null then add $clip_path to style attribute 
         */
        if ( '' == $width || null == $width ) {
            $add_width = '' ;
        } else {
            $add_width = ' width: '.$width.'; ' ;
        }

        if ( '' == $height || null == $height ) {
            $add_height = '' ;
        } else {
            $add_height = ' height: '.$height.'; ' ;
        }

        if ( '' == $clip_path || null == $clip_path ) {
            $add_clip_path = '' ;
        } else {
            $add_clip_path = ' clip-path: '.$clip_path.'; ' ;
        }


        // $array_attr = array(
        //     'class' => ' '.$class.' ',
        //     // 'style' => 'shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.' ',
        //     'style' =>  ' '.$add_width.' '.$add_height.'  shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.';  '.$general_margin.': '.$margin.'; '.$add_clip_path.' ',
        // );


        // $o = '';
        // // $o .= ' '. wp_get_attachment_image( $img_id, $array_size, '', $array_attr ).' ';
        // $o .= ' '. wp_get_attachment_image( esc_attr( $img_id ), '', '', $array_attr ).' '; 


        $array_attr_2 = array(
            'class' => ' '.$class.' ',
            // 'style' => 'shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.' ',
            'style' =>  ' '.$add_width.' '.$add_height.'  shape-outside: '.$shape_outside.' ; shape-margin: '.$margin.';  '.$general_margin.': '.$margin.'; '.$add_clip_path.' ',
        );

        $i = '';
        $i .= '<div class="main">';
        // $i .= '<div class="image">';
        $i .= ' '. wp_get_attachment_image( esc_attr( $img_id ), '', '', $array_attr_2 ).' ';
        // $i .= '</div>';
        $i .= '<div class="content">';
        $i .= '<span>';
        $i .= ' '.$content.' ';
        $i .= '</span>';
        $i .= '</div>';
        $i .= '</div>';
        $i .= '<div style="clear:both"></div>';



        
        return $i;
        // return $o;
    }



    /**
     * @deprecated 1.0.0 in favor of shape shortcode
     * 
     * 'shape'  - shortcode covers almost all the things, 
     * but this 'shape_svg' is easy in one way 
     * just add image in b/w shap_img shortcode.
     * i.e. [shape_svg] add image here [/shape_svg] 
     * but 'shape' shortcode have more options.  
     * 
     * 
     * wrap the shortcode with in image - [shape_svg]image [/shape_svg]
     * 
     * for svg, transparent images it good.. 
     *
     * @uses self::csh_shortcodes_init  - add_shortcode hook
     * 
     * @param array $atts -  an associative array of attributes, 
     *                       or an empty string if no attributes are given
     * @param string $content - the enclosed content 
     *                          (if the shortcode is used in its enclosing form)
     * @param string $shortcode - the shortcode tag, useful for shared callback functions
     * 
     * @return - html content with inline css - which return image, shape 
     */
    public function shape_svg( $atts = [], $content = 'null', $shortcode = '') {
        
        /**
         * 
         * @param int id - image id - based on this get the image path
         * @param string url  - image url - shape can be given using image id or direct url
         * @param string float - float - left or right - default to left
         * @param string margin - set shape-margin
         * @param string class  - to add class names
         * 
         * in this shorcode width, height is not needed, 
         * as this shortcode wrap to already exist/ seteled image with widht, height
         * 
         * @var int $img_id  - declare with shortcode attribute id to this variable
         * @var string $\float  - decalre with shortcode attribute float to this variable
         * @var string $margin  - declare with shortcode attribute margin value
         * @var string $url     - decalre with shortcode attribute url value
         * @var string $class     - decalre with shortcode attribute class value
         * 
         * @var string $url_id  - get image url based on given img id
         * @var string $shape_outside  - css shape-outside value - here given image url
         *                       works well if it is a transparent image, svg
         * @var string $float_class  - if float given is right - add csh-right - image flow to right
         *                     if left - add csh-left - default one - img flow to left
         * @var string $class  - add class names - img-80, img-90 - to make maxwidth to the image parent
         */
        $a = shortcode_atts(
            array(
                'id' => '',
                'url' => '',
                'float' => 'left',
                'margin' => '1em',
                'class' => '',
            ), $atts, $shortcode );
            // use like -  '.$a["title"].'   
        
        $img_id = esc_attr( $a["id"] );
        $float = esc_attr( $a["float"] );
        $margin = esc_attr( $a["margin"] );
        $url = esc_attr( $a["url"] );
        $class = esc_attr( $a["class"] );
        
        $url_id =  wp_get_attachment_url( $img_id );

        if ( '' == $url || null == $url ) {
            $shape_outside = "url($url_id)";
        } else {
            $shape_outside = "url($url)";
        }

        if( 'left' == $float) {
            $float_class = 'csh-left';
        } elseif ( 'right' == $float ) {
            $float_class = 'csh-right';
        }

        $o = '';
        $o .= '<span class=" '.$float_class.' '.$class.' shape" style="shape-outside: '.$shape_outside.'; shape-margin: '.$margin.' " >';
        $o .= $content;
        $o .= '</span>';
        
        return $o;
    }

            

    //  Register shortcodes
    public function csh_shortcodes_init() {
        add_shortcode('shape', array( $this, 'shape' ) );
        add_shortcode('shape_img', array( $this, 'shape_img' ) );

        // @deprecated 1.0.0 favor of shape shortcode
        add_shortcode('shape_svg', array( $this, 'shape_svg' ) );
    }

}

endif; // END class_exists check