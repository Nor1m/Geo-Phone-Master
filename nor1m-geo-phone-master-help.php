
<h2><?php _e('Help', 'ngp') ?></h2>
<div class="ngp_setting_block">
    <table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="blogdescription"><?php _e('Information', 'ngp') ?></label></th>
				<td>
				    <div class="help_items">
				        
				        <div class="item item_multi">
        	                <label><?php _e('Multi-city widget', 'ngp') ?></label>
        	                <br />
                			<p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGSC def_city='<?php _e('The default city', 'ngp') ?>' def_link='<?php _e('The default link', 'ngp') ?>' ]" /></p>
                			<div class="ngp_simple">
                			    <p class="ngp_head_simple"><?php _e('Example of use:', 'ngp') ?></p>
                			    <p class="ngp_text_simple"><?php _e('Shortcode:', 'ngp') ?> [NGSC def_city='<?php _e('Moscow:', 'ngp') ?>' def_link='msk.site.com' ]</p>
                			</div>
            			</div>
            			
				        <div class="item item_geo">
        	                <label><?php _e('Geo targeting', 'ngp') ?></label>
        	                <br />
                			<p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP label='Ярлык']<?php _e('Value if the condition is not met', 'ngp') ?>[/NGP]" /></p>
                			<div class="ngp_simple">
                                <p class="ngp_head_simple"><?php _e('Example of use:', 'ngp') ?></p>
                                <p class="ngp_text_simple"><?php _e('Shortcode:', 'ngp') ?> [NGP label='phone']...[/NGP]</p>
                			</div>
            			</div>
                        
                        <div class="item_info">
                            <label><?php _e('List of allowed tags and attributes for geotargeting rules', 'ngp') ?></label>
                            <br />
                            <div class="allowed_tags">
                                <table>
                                    <tr class="ngp_head_table">
                                        <td><?php _e('tag', 'ngp') ?></td>
                                        <td><?php _e('attribute', 'ngp') ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>p</b></td>
                                        <td>(class, id)</td>
                                    </tr>
                                    <tr>
                                        <td><b>a</b></td>
                                        <td>(href, class, id)</td>
                                    </tr>
                                    <tr>
                                        <td><b>b</b></td>
                                        <td>(class, id)</td>
                                    </tr>
                                    <tr>
                                        <td><b>i</b></td>
                                        <td>(class, id)</td>
                                    </tr>
                                    <tr>
                                        <td><b>span</b></td>
                                        <td>(class, id)</td>
                                    </tr>
                                    <tr>
                                        <td><b>strong</b></td>
                                        <td>(class, id)</td>
                                    </tr>
                                    <tr>
                                        <td><b>br</b></td>
                                        <td> </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        <div class="item_box">
                            <div class="item">
                                <label><?php _e('Geo targeting: print country', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO country]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple"><?php _e('Russia', 'ngp') ?></p>
                                </div>
                            </div>

                            <div class="item">
                                <label><?php _e('Geo targeting: print region', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO region]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple"><?php _e('Florida', 'ngp') ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="item_box"> 
                            <div class="item">
                                <label><?php _e('Geo targeting: print city', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO city]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple"><?php _e('New-York', 'ngp') ?></p>
                                </div>
                            </div>
                            <div class="item">
                                <label><?php _e('Geo targeting: print IP', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO IP]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple">127.0.0.7</p>
                                </div>
                            </div>
                        </div>

                        <div class="item_box">
                            <div class="item">
                                <label><?php _e('Geo targeting: print country ISO', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO country_iso]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple">KR</p>
                                </div>
                            </div>
                            <div class="item">
                                <label><?php _e('Geo targeting: print region ISO', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO region_iso]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple">KR-11</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="item_box">
                            <div class="item">
                                <label><?php _e('Geo targeting: print country lon', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO country_lon]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple">32.2525</p>
                                </div>
                            </div>
                            <div class="item">
                                <label><?php _e('Geo targeting: print country lat', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO country_lat]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple">22.526</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="item_box">
                            <div class="item">
                                <label><?php _e('Geo targeting: print region lon', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO region_lon]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple">31.25</p>
                                </div>
                            </div>
                            <div class="item">
                                <label><?php _e('Geo targeting: print region lat', 'ngp') ?></label>
                                <br />
                                <p class="ngp_shortcode"><?php _e('Shortcode:', 'ngp') ?> <input type="text" name="ngp_short_input" value="[NGP_MY_GEO region_lat]" /></p>
                                <div class="ngp_simple">
                                    <p class="ngp_head_simple"><?php _e('Examle response:', 'ngp') ?></p>
                                    <p class="ngp_text_simple">21</p>
                                </div>
                            </div>
                        </div>
                        
            	    </div>
	                <div class="ngp_help_developer">
	                    <p>
	                        <a href="mailto:http://nor1msoft@mail.ru" target="_blank" class="ngp_help"><?php _e('You can contact me', 'ngp') ?></a>
	                        <a href="http://nor1m.ru" target="_blank" class="ngp_developer"><?php _e('Developer site', 'ngp') ?></a>
	                        <a href="https://paypal.me/nor1m" target="_blank" class="ngp_donate"><?php _e('Donate', 'ngp') ?></a>
	                    </p>
	               </div>
				</td>
			</tr>
		</tbody>
	</table>
</div>


