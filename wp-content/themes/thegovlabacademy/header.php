<?php ob_start(); ?>
<!doctype html>

<!--[if lt IE 7]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]>
<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]>
<html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
  <meta charset="utf-8">

  <?php // Google Chrome Frame for IE ?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php wp_title(''); ?></title>

  <?php // mobile meta (hooray!) ?>
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
  <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
  <!--[if IE]>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
  <![endif]-->
  <?php // or, set /favicon.ico for IE10 win ?>
  <meta name="msapplication-TileColor" content="#f01d4f">
  <meta name="msapplication-TileImage"
        content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <?php // wordpress head functions ?>
  <?php wp_head(); ?>
  <?php // end of wordpress head ?>

  <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/library/css/styles.css' type='text/css'
        media='all'/>
  <link rel='stylesheet' href='<?php echo get_template_directory_uri(); ?>/library/css/colors.css' type='text/css'
        media='all'/>

  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.1/css/font-awesome.min.css" rel="stylesheet">

  <?php // drop Google Analytics Here ?>
  <?php // end analytics ?>

</head>

<body <?php body_class(); ?>>

<header class="header" role="banner"> <!-- Header and Navigation -->
  <div class="content">
    <div class="wrapper ">
      <h1 class="govlab-academy-logo">
        <a href="<?php echo home_url(); ?>" rel="nofollow">
        </a>
      </h1>

      <div class="institutional-menu">
        <div id="subscribe" class="subscribe-form">
          <a class="subscribe-button" href="#">Subscribe</a>

            <script type="text/javascript">var submitted=false;</script>
            <iframe name="hidden_iframe" id="hidden_iframe" style="display:none;"
                    onload="if(submitted) {window.location='';}"></iframe>
            <form action="https://docs.google.com/a/p2pu.org/forms/d/10_hpJEe-PWITqwTfLHZkpjxlnqlgmS71pHG8Uz00Uek/formResponse"
                  method="POST" id="ss-form" onsubmit="" target="hidden_iframe"
                  onsubmit="submitted=true;" data-validate="parsley">
              <div class="subscribe-email">
                <h4>Subscribe to our newsletter</h4>
                <a href="#" class="subscribe-email-action ">OK</a>
                <div class="parsley-container">
                  <input type="text" name="entry.1925900036" value="" class="ss-q-short" id="entry_1925900036"
                         dir="auto" aria-required="true" required="true" title="" placeholder="Email"
                         data-required="true" type="email" data-type="email" data-trigger="change keyup focusin focusout">
                </div>
              </div>

              <div id="modal-subscribe-successful" class="modal">

                <h1>Subscription Sucessful!</h1>
                <h2>Please help our research <br> by answering a few questions?</h2>
                <div class="parsley-container" style="float: right;">
                  <select name="entry.2068497808" id="entry_2068497808" class="valid" data-required="true"
                        data-trigger="change keyup focusin focusout">
                    <option value="">Choose your Country</option>
                    <option value="United States of America">United States of America</option>
                    <option value="Afghanistan">Afghanistan</option>
                    <option value="Africa">Africa</option>
                    <option value="Albania">Albania</option>
                    <option value="Algeria">Algeria</option>
                    <option value="American Samoa">American Samoa</option>
                    <option value="Andorra">Andorra</option>
                    <option value="Angola">Angola</option>
                    <option value="Anguilla">Anguilla</option>
                    <option value="Antarctica">Antarctica</option>
                    <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                    <option value="Antilles, Netherlands">Antilles, Netherlands</option>
                    <option value="Arabia, Saudi">Arabia, Saudi</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Armenia">Armenia</option>
                    <option value="Aruba">Aruba</option>
                    <option value="Australia">Australia</option>
                    <option value="Austria">Austria</option>
                    <option value="Azerbaijan">Azerbaijan</option>
                    <option value="Bahamas, The">Bahamas, The</option>
                    <option value="Bahrain">Bahrain</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Barbados">Barbados</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Belgium">Belgium</option>
                    <option value="Belize">Belize</option>
                    <option value="Benin">Benin</option>
                    <option value="Bermuda">Bermuda</option>
                    <option value="Bhutan">Bhutan</option>
                    <option value="Bolivia">Bolivia</option>
                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                    <option value="Botswana">Botswana</option>
                    <option value="Bouvet Island">Bouvet Island</option>
                    <option value="Brazil">Brazil</option>
                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                    <option value="British Virgin Islands">British Virgin Islands</option>
                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                    <option value="Bulgaria">Bulgaria</option>
                    <option value="Burkina Faso">Burkina Faso</option>
                    <option value="Burundi">Burundi</option>
                    <option value="Cambodia">Cambodia</option>
                    <option value="Cameroon">Cameroon</option>
                    <option value="Canada">Canada</option>
                    <option value="Cape Verde">Cape Verde</option>
                    <option value="Cayman Islands">Cayman Islands</option>
                    <option value="Central African Republic">Central African Republic</option>
                    <option value="Chad">Chad</option>
                    <option value="Chile">Chile</option>
                    <option value="China">China</option>
                    <option value="Christmas Island">Christmas Island</option>
                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                    <option value="Colombia">Colombia</option>
                    <option value="Comoros">Comoros</option>
                    <option value="Congo">Congo</option>
                    <option value="Congo, Democratic Rep. of the">Congo, Democratic Rep. of the</option>
                    <option value="Cook Islands">Cook Islands</option>
                    <option value="Cote D'Ivoire">Cote D'Ivoire</option>
                    <option value="Croatia">Croatia</option>
                    <option value="Cuba">Cuba</option>
                    <option value="Cyprus">Cyprus</option>
                    <option value="Czech Republic">Czech Republic</option>
                    <option value="Denmark">Denmark</option>
                    <option value="Djibouti">Djibouti</option>
                    <option value="Dominica">Dominica</option>
                    <option value="Dominican Republic">Dominican Republic</option>
                    <option value="East Timor (Timor-Leste)">East Timor (Timor-Leste)</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Egypt">Egypt</option>
                    <option value="El Salvador">El Salvador</option>
                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                    <option value="Eritrea">Eritrea</option>
                    <option value="Estonia">Estonia</option>
                    <option value="Ethiopia">Ethiopia</option>
                    <option value="European Union">European Union</option>
                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                    <option value="Faroe Islands">Faroe Islands</option>
                    <option value="Fiji">Fiji</option>
                    <option value="Finland">Finland</option>
                    <option value="France">France</option>
                    <option value="French Guiana">French Guiana</option>
                    <option value="French Polynesia">French Polynesia</option>
                    <option value="French Southern Territories - TF">French Southern Territories - TF</option>
                    <option value="Gabon">Gabon</option>
                    <option value="Gambia, The">Gambia, The</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Germany">Germany</option>
                    <option value="Ghana">Ghana</option>
                    <option value="Gibraltar">Gibraltar</option>
                    <option value="Greece">Greece</option>
                    <option value="Greenland">Greenland</option>
                    <option value="Grenada">Grenada</option>
                    <option value="Guadeloupe">Guadeloupe</option>
                    <option value="Guam">Guam</option>
                    <option value="Guatemala">Guatemala</option>
                    <option value="Guernsey and Alderney">Guernsey and Alderney</option>
                    <option value="Guinea">Guinea</option>
                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                    <option value="Guinea, Equatorial">Guinea, Equatorial</option>
                    <option value="Guiana, French">Guiana, French</option>
                    <option value="Guyana">Guyana</option>
                    <option value="Haiti">Haiti</option>
                    <option value="Heard and McDonald Islands">Heard and McDonald Islands</option>
                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                    <option value="Holland (see Netherlands)">Holland (see Netherlands)</option>
                    <option value="Honduras">Honduras</option>
                    <option value="Hong Kong, China">Hong Kong, China</option>
                    <option value="Hungary">Hungary</option>
                    <option value="Iceland">Iceland</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                    <option value="Iraq">Iraq</option>
                    <option value="Ireland">Ireland</option>
                    <option value="Ivory Coast">Ivory Coast</option>
                    <option value="Italy">Italy</option>
                    <option value="Jamaica">Jamaica</option>
                    <option value="Japan">Japan</option>
                    <option value="Jersey">Jersey</option>
                    <option value="Jordan">Jordan</option>
                    <option value="Kazakhstan">Kazakhstan</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Kiribati">Kiribati</option>
                    <option value="Korea, Demo. People's Rep. of">Korea, Demo. People's Rep. of</option>
                    <option value="Korea, (South) Republic of">Korea, (South) Republic of</option>
                    <option value="Kuwait">Kuwait</option>
                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                    <option value="Latvia">Latvia</option>
                    <option value="Lebanon">Lebanon</option>
                    <option value="Lesotho">Lesotho</option>
                    <option value="Liberia">Liberia</option>
                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                    <option value="Liechtenstein">Liechtenstein</option>
                    <option value="Lithuania">Lithuania</option>
                    <option value="Luxembourg">Luxembourg</option>
                    <option value="Macao, (China)">Macao, (China)</option>
                    <option value="Macedonia, TFYR">Macedonia, TFYR</option>
                    <option value="Madagascar">Madagascar</option>
                    <option value="Malawi">Malawi</option>
                    <option value="Malaysia">Malaysia</option>
                    <option value="Maldives">Maldives</option>
                    <option value="Mali">Mali</option>
                    <option value="Malta">Malta</option>
                    <option value="Man, Isle of">Man, Isle of</option>
                    <option value="Marshall Islands">Marshall Islands</option>
                    <option value="Martinique">Martinique</option>
                    <option value="Mauritania">Mauritania</option>
                    <option value="Mauritius">Mauritius</option>
                    <option value="Mayotte">Mayotte</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                    <option value="Monaco">Monaco</option>
                    <option value="Mongolia">Mongolia</option>
                    <option value="Montenegro">Montenegro</option>
                    <option value="Montserrat">Montserrat</option>
                    <option value="Morocco">Morocco</option>
                    <option value="Mozambique">Mozambique</option>
                    <option value="Myanmar (ex-Burma)">Myanmar (ex-Burma)</option>
                    <option value="Namibia">Namibia</option>
                    <option value="Nauru">Nauru</option>
                    <option value="Nepal">Nepal</option>
                    <option value="Netherlands">Netherlands</option>
                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                    <option value="New Caledonia">New Caledonia</option>
                    <option value="New Zealand">New Zealand</option>
                    <option value="Nicaragua">Nicaragua</option>
                    <option value="Niger">Niger</option>
                    <option value="Nigeria">Nigeria</option>
                    <option value="Niue">Niue</option>
                    <option value="Norfolk Island">Norfolk Island</option>
                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                    <option value="Norway">Norway</option>
                    <option value="Oman">Oman</option>
                    <option value="Pakistan">Pakistan</option>
                    <option value="Palau">Palau</option>
                    <option value="Palestinian Territory">Palestinian Territory</option>
                    <option value="Panama">Panama</option>
                    <option value="Papua New Guinea">Papua New Guinea</option>
                    <option value="Paraguay">Paraguay</option>
                    <option value="Peru">Peru</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Pitcairn Island">Pitcairn Island</option>
                    <option value="Poland">Poland</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Puerto Rico">Puerto Rico</option>
                    <option value="Qatar">Qatar</option>
                    <option value="Reunion">Reunion</option>
                    <option value="Romania">Romania</option>
                    <option value="Russia (Russian Federation)">Russia (Russian Federation)</option>
                    <option value="Rwanda">Rwanda</option>
                    <option value="Sahara">Sahara</option>
                    <option value="Saint Helena">Saint Helena</option>
                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                    <option value="Saint Lucia">Saint Lucia</option>
                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                    <option value="Samoa">Samoa</option>
                    <option value="San Marino">San Marino</option>
                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                    <option value="Saudi Arabia">Saudi Arabia</option>
                    <option value="Senegal">Senegal</option>
                    <option value="Serbia">Serbia</option>
                    <option value="Seychelles">Seychelles</option>
                    <option value="Sierra Leone">Sierra Leone</option>
                    <option value="Singapore">Singapore</option>
                    <option value="Slovakia">Slovakia</option>
                    <option value="Slovenia">Slovenia</option>
                    <option value="Solomon Islands">Solomon Islands</option>
                    <option value="Somalia">Somalia</option>
                    <option value="South Africa">South Africa</option>
                    <option value="S. Georgia and S. Sandwich Is.">S. Georgia and S. Sandwich Is.</option>
                    <option value="Spain">Spain</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <option value="Sudan">Sudan</option>
                    <option value="Suriname">Suriname</option>
                    <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen Islands</option>
                    <option value="Swaziland">Swaziland</option>
                    <option value="Sweden">Sweden</option>
                    <option value="Switzerland">Switzerland</option>
                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                    <option value="Taiwan">Taiwan</option>
                    <option value="Tajikistan">Tajikistan</option>
                    <option value="Tanzania, United Republic of ">Tanzania, United Republic of</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Timor-Leste (East Timor)">Timor-Leste (East Timor)</option>
                    <option value="Togo">Togo</option>
                    <option value="Tokelau">Tokelau</option>
                    <option value="Tonga">Tonga</option>
                    <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                    <option value="Tunisia">Tunisia</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Turkmenistan">Turkmenistan</option>
                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                    <option value="Tuvalu">Tuvalu</option>
                    <option value="Uganda">Uganda</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="US Minor Outlying Islands">US Minor Outlying Islands</option>
                    <option value="Uruguay">Uruguay</option>
                    <option value="Uzbekistan">Uzbekistan</option>
                    <option value="Vanuatu">Vanuatu</option>
                    <option value="Vatican City State (Holy See)">Vatican City State (Holy See)</option>
                    <option value="Venezuela">Venezuela</option>
                    <option value="Viet Nam">Viet Nam</option>
                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                    <option value="Western Sahara">Western Sahara</option>
                    <option value="Yemen">Yemen</option>
                    <option value="Zambia">Zambia</option>
                    <option value="Zimbabwe">Zimbabwe</option>
                  </select>
                </div>
                <div class="parsley-container">
                  <input type="text" name="entry.42963135" value="" class="ss-q-short" id="entry_42963135"
                         dir="auto" title=""  placeholder="Name" data-required="true" data-trigger="change keyup focusin focusout">
                </div>

                  <fieldset>
                    <h3><label for="">I work in</label></h3>
                    <div class="parsley-container">
                      <ul class="ss-choices">
                        <li class="ss-choice-item">
                          <label>
                          <span class="ss-choice-item-control goog-inline-block">
                            <input type="checkbox" name="entry.1732365831" value="Government" id="group_1732365831_1"
                                   class="ss-q-checkbox" data-group="work-field" data-mincheck="1" data-trigger="change">
                          </span>
                            <span class="ss-choice-label">Government</span>
                          </label></li>
                        <li class="ss-choice-item">
                          <label>
                          <span class="ss-choice-item-control goog-inline-block">
                            <input type="checkbox" name="entry.1732365831" value="Civil society/ Non-profit"
                                   id="group_1732365831_2" class="ss-q-checkbox" data-group="work-field">
                          </span>
                            <span class="ss-choice-label">Civil society/ Non-profit</span>
                          </label></li>
                        <li class="ss-choice-item">
                          <label>
                          <span class="ss-choice-item-control goog-inline-block">
                            <input type="checkbox" name="entry.1732365831" value="Private sector" id="group_1732365831_3"
                                   class="ss-q-checkbox" data-group="work-field">
                          </span>
                            <span class="ss-choice-label">Private sector</span>
                          </label></li>
                        <li class="ss-choice-item">
                          <label>
                          <span class="ss-choice-item-control goog-inline-block">
                            <input
                              type="checkbox" name="entry.1732365831" value="Education" id="group_1732365831_4"
                              class="ss-q-checkbox" data-group="work-field">
                          </span>
                            <span class="ss-choice-label">Education</span>
                          </label>
                        </li>
                        <li class="ss-choice-item">
                          <input type="checkbox" name="entry.1732365831" value="__other_option__" id="group_1732365831_5"
                                 class="ss-q-checkbox other-toggle" data-group="work-field" style="margin-top: 8px">
                          <label for="group_1732365831_5" style="display: inline">Other:</label>
                          <input type="text" name="entry.1732365831.other_option_response" value="" class="q-other"
                                 id="entry_1732365831_other_option_response" dir="auto" aria-label="Other" disabled>

                        </li>
                      </ul>
                    </div>

                  </fieldset>
                  <fieldset>
                    <h3><label for="">I am interested in</label></h3>
                    <div class="parsley-container">
                      <ul class="ss-choices">
                      <li class="ss-choice-item">
                        <label>
                          <span class="ss-choice-item-control goog-inline-block">
                            <input type="checkbox" name="entry.2059951128" value="New research" id="group_2059951128_1"
                              class="ss-q-checkbox" data-group="interest" data-mincheck="1" data-trigger="change">
                          </span>
                          <span class="ss-choice-label">New research</span>
                        </label></li>
                      <li class="ss-choice-item">
                        <label>
                          <span class="ss-choice-item-control goog-inline-block">
                            <input type="checkbox" name="entry.2059951128" value="Courses I can sign-up for"
                              id="group_2059951128_2" class="ss-q-checkbox" data-group="interest">
                          </span>
                          <span class="ss-choice-label">Courses I can sign-up for</span>
                        </label>
                      </li>
                      <li class="ss-choice-item">
                        <label>
                          <span class="ss-choice-item-control goog-inline-block">
                            <input type="checkbox" name="entry.2059951128" value="Learning materials for independent study"
                              id="group_2059951128_3" class="ss-q-checkbox" data-group="interest">
                          </span>
                          <span class="ss-choice-label">Learning materials for independent study</span>
                        </label>
                      </li>
                      <li class="ss-choice-item">
                        <label>
                          <span class="ss-choice-item-control goog-inline-block">
                            <input type="checkbox" name="entry.2059951128" value="Conferences to attend"
                              id="group_2059951128_4" class="ss-q-checkbox" data-group="interest">
                          </span>
                          <span class="ss-choice-label">Conferences to attend</span>
                        </label>
                      </li>
                      <li class="ss-choice-item">
                        <input type="checkbox" name="entry.2059951128" value="__other_option__" id="group_2059951128_5"
                          class="ss-q-checkbox other-toggle" data-group="interest" style="margin-top: 8px">
                        <label for="group_2059951128_5" style="display: inline">Other:</label>
                        <input type="text" name="entry.2059951128.other_option_response" value="" class="q-other"
                               id="entry_2059951128_other_option_response" dir="auto" aria-label="Other" disabled>
                      </li>
                    </ul>
                    </div>
                  </fieldset>
                  <input type="submit" class="button subscribe-cancel" value="Cancel">
                  <input type="submit" name="submit" value="OK" id="ss-submit" class="button subscribe-submit confirm">
              </div>

              <input type="hidden" name="draftResponse" value="[]">
              <input type="hidden" name="pageHistory" value="0">
            </form>

        </div>
        <?php wp_nav_menu(array('theme_location' => 'institutional_menu')); ?>
      </div>
    </div>
  </div>
</header>
<section class="content-top"> <!-- Main Slider -->
  <div class="wrapper relative">
    <?php wp_nav_menu(array('theme_location' => 'theme_menu', 'container_class' => 'theme-menu')); ?>
  </div>
</section>
