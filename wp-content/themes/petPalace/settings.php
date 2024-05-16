<?php
//Om du inte är på admin-sidan, körs inte koden
if(is_admin() == false){
    return;
}
// Lägger till menyalternativet "Butik" i dashboard under "Settings"
function petPalace_add_settings(){
    add_submenu_page(
        'options-general.php',
        "Butik",
        "Butik",
        "edit_pages",
        "butik",
        "petPalace_add_settings_callback"
    );
}

function petPalace_add_settings_callback(){
    ?>
        <div class="wrap">
            <h2>Inställningar</h2>
            <form action="options.php" method="post">
                <?php
                    settings_fields("butik");
                    do_settings_sections("butik");
                    submit_button();
                ?>
            </form>
        </div>
    <?php
}

add_action('admin_menu', 'petPalace_add_settings');

// Registrerar inställningar tillgängliga på sidan "Butik"
function petPalace_add_settings_init(){          
     // Lägger till inställningar för rea-bannern
     add_settings_section(
        "butik_sale_banner",
        "Sale Banner",
        "petPalace_add_sale_banner_section",
        "butik"
    );
    register_setting(
        "butik",
        "sale_banner_message"
    );
    register_setting(
        "butik",
        "display_sale_banner"
    );
    add_settings_field(
        "sale_banner_message",
        "Sale Banner Message",
        "petPalace_section_setting",
        "butik",
        "butik_sale_banner",
        array(
            "option_name" => "sale_banner_message",
            "option_type" => "text"
        )
    );
    add_settings_field(
        "display_sale_banner",
        "Display Sale Banner",
        "petPalace_display_sale_banner_setting",
        "butik",
        "butik_sale_banner"
    );
}


add_action('admin_init', 'petPalace_add_settings_init');


// Ritar ut sektionen "general" beskrivning
function petPalace_add_settings_section_general(){
    echo "<p>Generella inställningar för butiken</p>";
}

//Ritar ut inställningsfält
function petPalace_section_setting($args){
    $option_name = $args["option_name"];
    $option_type = $args["option_type"];
    $option_value = get_option($args["option_name"]);
    echo '<input type="' . $option_type . '" id="' . $option_name . '" name="' . $option_name . '"    value="'. $option_value .'"/>';
}


// Ritar ut sektionen för rea-bannern
function petPalace_add_sale_banner_section(){
    echo "<p>Inställningar för rea-bannern</p>";
}

// Ritar ut inställningsfältet för att välja om rea-bannern ska visas eller inte
function petPalace_display_sale_banner_setting(){
    $option_name = "display_sale_banner";
    $option_value = get_option($option_name);
    echo '<input type="checkbox" id="' . $option_name . '" name="' . $option_name . '" value="1" ' . checked(1, $option_value, false) . '/>';
}