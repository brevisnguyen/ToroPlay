<?php
//define( 'WP_DEBUG', true );
$path = preg_replace('/wp-content.*$/', '', __DIR__);
require_once($path . 'wp-load.php');
require_once($path . 'wp-includes/wp-db.php');
require_once($path . 'wp-admin/includes/taxonomy.php');
require_once('splt-curl.php');

global $wpdb, $curl;
$time = date("Y:m:d H:i:s", time());
$curl = new cURL();

if ($_GET['type'] == "numpage") {
	$urlss = urldecode($_GET['url']);
	$urlss = trim(str_replace(" ", "", $urlss));
	$fetch_type = "";
	if ($_GET['fetchtype'] == "today") {
		$fetch_type = 24;
	}

	$response = vod_json_pagecount($urlss, $fetch_type);
	echo $response;
}

if ($_GET['type'] == "pagedetail") {
	$urlss = urldecode($_GET['url']);
	$urlss = trim(str_replace(" ", "", $urlss));
	$page = $_GET['numpage'];

	$response = vod_data($urlss, $page);
	echo $response;
}

function vod_json_pagecount($url, $fetch_type)
{
	global $curl;
	$url_param = [];
	$url_param['h'] = $fetch_type;
	$url_param['ac'] = 'list';
	if (strpos($url, '?') === false) {
		$url .= '?';
	} else {
		$url .= '&';
	}
	$url .= http_build_query($url_param);
	$response = $curl->get($url);

	$response = filter_tags($response);
	$json = json_decode($response, true);
	if (!$json) {
		return json_encode(['code' => 1002, 'msg' => 'Mẫu JSON không đúng, không hỗ trợ thu thập']);
	}
	$url_return = generate_url($url, $fetch_type);
	$array_page = [];
	$array_page['code'] = 1;
	$array_page['page'] = $json['page'];
	$array_page['pagecount'] = $json['pagecount'];
	$array_page['pagesize'] = intval($json['limit']);
	$array_page['recordcount'] = $json['total'];
	$array_page['url'] = $url_return;

	return json_encode($array_page);
}

function generate_url($url, $fetch_type)
{
	$url_param = [];
	$url_param['t'] = '';
	$url_param['h'] = $fetch_type;
	$url_param['ids'] = '';
	$url_param['wd'] = '';
	$url_param['mid'] = 1;
	$url_param['limit'] = 30;
	$url_param['sync_pic_opt'] = 0;
	$url_param['opt'] = 0;
	$url_param['filter'] = 0;
	$url_param['ac'] = 'detail';
	if (strpos($url, '?') === false) {
		$url .= '?';
	} else {
		$url .= '&';
	}
	$url .= http_build_query($url_param);
	return $url;
}

function vod_data($url, $page)
{
	global $curl;
	$url_param = [];
	$url_param['pg'] = is_numeric($page) ? $page : '';
	if (strpos($url, '?') === false) {
		$url .= '?';
	} else {
		$url .= '&';
	}
	$url .= http_build_query($url_param);
	$result = checkUrl($url);
	if ($result['code'] > 1) {
		return json_encode($result);
	}
	$html = $curl->get($url);
	if (empty($html)) {
		return json_encode(['code' => 1001, 'msg' => 'Liên kết API thất bại, thông thường mạng máy chủ không ổn định ,chết IP,cấm dùng hàm số liên quan']);
	}
	$html = filter_tags($html);
	$json = json_decode($html, true);
	if (!$json) {
		return json_encode(['code' => 1002, 'msg' => 'Mẫu JSON không đúng, không hỗ trợ thu thập']);
	}
	$data = pre_handle($json);
	$msg = handle_data($data);
	return json_encode($msg);
}

/**
 * handle data
 * @param {*} data
 * @returns {array}
 */
function handle_data($data)
{
	global $wpdb;
	$saved_post_count = 0;
	$post_count = count($data);
	$msg = [];
	foreach ($data as $key => $val) {
		// Category
		$genres = explode(',', $val['vod_class']);
		$genres_catid = [];
		if ($genres) {
			foreach ($genres as $valuegenres) {
				$tempcatt = get_category_by_slug($valuegenres);
				if ($tempcatt) {
					$genres_catid[] = $tempcatt->cat_ID;
				} else {
					$genres_catid[] = wp_create_category($valuegenres);
				}
			}
		}
		$time = current_time('mysql');
		$slug = trim($val['vod_en']);
		$title = trim($val['vod_name']);
		$check_dup = $wpdb->get_results("SELECT ID FROM `$wpdb->posts` WHERE `post_name`='$slug'  AND `post_type` IN ('series','movies')");
		$check_dup1 = $wpdb->get_results("SELECT ID FROM `$wpdb->posts` WHERE `post_title`='$title'  AND `post_type` IN ('series','movies')  AND `post_status`='publish'");
		if ($check_dup1[0]) {  // duplicate post title
			if (count($check_dup1) == 1) {
				$pidssss = $check_dup1[0]->ID;
				$halim_metabox_options0 = $wpdb->get_var("SELECT `meta_value` FROM `$wpdb->postmeta` WHERE `meta_key`='_halim_metabox_options' AND `post_id`='$pidssss'");
				$halim_metabox_options1 = unserialize($halim_metabox_options0);

				$dup_ogri_name = $halim_metabox_options1['halim_original_title'];
				if (trim($dup_ogri_name) == trim($val['vod_name'])) {
					if ($halim_metabox_options1['halim_episode'] != $val['status']) {
						// dupdup2:
						$pidssss = $check_dup1[0]->ID;
						$halim_metabox_options1['halim_episode'] = '[ Tập ' . $val['status']['epnow'] . '/' . $val['status']['eptotal'] . ' - End ]';
						$halim_metabox_options1['halim_total_episode'] = $val['status']['eptotal'];
						if ($val['status']['epnow'] > 1) {
							$halim_metabox_options1['halim_movie_formality'] = 'tv_series';
						} else {
							$halim_metabox_options1['halim_movie_formality'] = 'single_movies';
						}
						$wpdb->update($wpdb->postmeta, array('meta_value' =>  serialize($halim_metabox_options1)), array('post_id' => $pidssss, 'meta_key' => '_halim_metabox_options'));
						$wpdb->update($wpdb->prefix . 'posts', array('post_modified' =>  $time, 'post_modified_gmt' => $time), array('ID' => $pidssss));
						// link stream
						$halimmovies2 = json_encode($val['vod_play_list'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
						$wpdb->update($wpdb->postmeta, array('meta_value' =>  serialize($halimmovies2)), array('post_id' => $pidssss, 'meta_key' => '_halimmovies'));
						array_push($msg, 'Cập nhật [' . $title . '] thành công');
					} else {
						array_push($msg, 'Trùng lặp bài viết [' . $title . ']');
					}
				}
			}
			continue;
		} elseif ($check_dup[0]) {  // duplicate post slug
			$slug = $slug . '-' . $val['vod_year'];
			goto nodup;
		} else {
			nodup:
			// insert single movies
			if ($val['type_id_1'] == 1) {
				$contentsave = array(
					'post_author' => $_GET['author'],
					'post_title' =>  $title,
					'post_name' => $slug,
					'post_content' => $val['vod_content'],
					'post_status' => 'publish',
					'post_type' =>  'movies',
					'post_date' => $time,
					'post_date_gmt' => $time,
					'post_modified' => $time,
					'post_modified_gmt' => $time
				);
				$wpdb->insert($wpdb->prefix . 'posts', $contentsave, array('%s', '%d'));
				$post_id = $wpdb->insert_id;
				wp_set_post_terms($post_id, $genres_catid, 'category', false);
				$wpdb->update($wpdb->prefix . 'posts', array('post_title' =>  $title, 'guid' => get_site_url() . '?p=' . $post_id), array('ID' => $post_id));
				$saved_post_count++;
				array_push($msg, 'Thu thập thành công [' . $title . ']');

				// insert postmeta
				add_post_meta($post_id, 'field_title',  $title);
				add_post_meta($post_id, 'field_date', $time);
				add_post_meta($post_id, 'poster_hotlink',$val['vod_pic']);
				add_post_meta($post_id, 'backdrop_hotlink',  $val['vod_pic']);
				$field_runtime = $val['status']['minutes'] . ' phút';
				add_post_meta($post_id, 'field_runtime', $field_runtime);

				// Update link stream to post_meta
				$server1 = $wpdb->get_results("SELECT a.term_id  FROM `$wpdb->term_taxonomy` AS a JOIN `$wpdb->terms` AS b  ON a.term_id=b.term_id  WHERE a.taxonomy='server' AND b.name ='nguon'");
				$server2 = $wpdb->get_results("SELECT a.term_id  FROM `$wpdb->term_taxonomy` AS a JOIN `$wpdb->terms` AS b  ON a.term_id=b.term_id  WHERE a.taxonomy='server' AND b.name ='m3u8'");
				$quality = $wpdb->get_results("SELECT term_id  FROM `$wpdb->term_taxonomy` WHERE `taxonomy`='quality'");
				$lang = $wpdb->get_results("SELECT term_id  FROM `$wpdb->term_taxonomy` WHERE `taxonomy`='language'");
				$i = 0;
				foreach ($val['vod_play_list'] as $play) {
					$array_links = array(
						'type' => '1',
						'server' => $play['server_name'] == 'nguon' ? $server1[0]->term_id : $server2[0]->term_id,
						'lang' => isset($lang) ? $lang[0]->term_id : '',
						'quality' => isset($quality) ? $quality[0]->term_id : '',
						'link' => isset($play['server_data']['link']) ? base64_encode(stripslashes(esc_textarea($play['server_data']['link']))) : '',
						'date' => date('d') . '/' . date('m') . '/' . date('Y'),

					);
					add_post_meta($post_id, 'trglinks_' . $i, serialize($array_links));
					$i++;
				};
				add_post_meta($post_id, 'trgrabber_tlinks', count($val['vod_play_list']));

				// insert actor, director
				$actor = explode(',', $val['vod_actor']);
				$couuuu = count($actor);
				for ($ll = 0; $ll < $couuuu - 1; $ll++) {
					wp_set_object_terms($post_id, array('cast' => trim($actor[$ll])), 'cast', true);
				}
				wp_set_object_terms($post_id, array('directors' => $val['vod_director']), 'directors');
				wp_set_object_terms($post_id, array('country' => $val['vod_area']), 'country');
				wp_set_object_terms($post_id, array('release' => $val['vod_year']), 'release');
			}
			// insert serial movies
			elseif ($val['type_id_1'] == 2) {
				$contentsave = array(
					'post_author' => $_GET['author'],
					'post_title' =>  $title,
					'post_name' => $slug,
					'post_content' => $val['vod_content'],
					'post_status' => 'publish',
					'post_type' =>  'series',
					'post_date' => $time,
					'post_date_gmt' => $time,
					'post_modified' => $time,
					'post_modified_gmt' => $time,
				);
				$wpdb->insert($wpdb->prefix . 'posts', $contentsave, array('%s', '%d'));
				$post_id = $wpdb->insert_id;
				wp_set_post_terms($post_id, $genres_catid, 'category', false);
				$wpdb->update($wpdb->prefix . 'posts', array('post_title' =>  $title, 'guid' => get_site_url() . '?p=' . $post_id), array('ID' => $post_id));
				$saved_post_count++;
				array_push($msg, 'Thu thập thành công [' . $title . ']');

				// insert postmeta
				add_post_meta($post_id, 'field_title', $title);
				add_post_meta($post_id, 'field_date', $time);
				add_post_meta($post_id, 'poster_hotlink', $val['vod_pic']);
				add_post_meta($post_id, 'backdrop_hotlink', $val['vod_pic']);
				add_post_meta($post_id, 'field_runtime', 50);
				add_post_meta($post_id, 'number_of_seasons', 1);
				add_post_meta($post_id, 'status', $val['status']);
				add_post_meta($post_id, 'field_id', $post_id);
				add_post_meta($post_id, 'tr_post_type', 2);

				// Insert seasons movies
				$cid = wp_insert_term($title . ' 1', 'seasons');
				$cid = !is_wp_error($cid) ? intval($cid['term_id']) : intval($cid->error_data['term_exists']);

				wp_set_object_terms($post_id, $cid, 'seasons', true);
				$array_post_meta = array(

					'air_date' => isset($time) ? $time : '',
					'name' => 'Season 1',
					'id' => '',
					'overview' => '',
					'poster_path_hotlink' => isset($val['vod_pic']) ? $val['vod_pic'] : '',
					'poster_path' => '',
					'number_of_episodes' => 0,
					'tr_id_post' => $post_id,
					'season_number' => 1
				);
				foreach ($array_post_meta as $key => $value) {

					$new_meta_value = (isset($value) ? ($value) : '');
					$meta_value = is_array(get_term_meta($cid, $key, true)) ? array_map('stripslashes', get_term_meta($cid, $key, true)) : stripslashes(get_term_meta($cid, $key, true));

					if ($new_meta_value && '' == $meta_value) {
						add_term_meta($cid, $key, $new_meta_value, true);
					} elseif ($new_meta_value && $new_meta_value != $meta_value) {
						update_term_meta($cid, $key, $new_meta_value);
					} elseif ('' == $new_meta_value && $meta_value) {
						delete_term_meta($cid, $key, $meta_value);
					}
				}
				wp_update_term($cid, 'seasons', array(
					'name' => $title . ' - Season 1',
					'slug' => $slug . ' 1'
				));
				// insert episodes movies
				$i = 1;
				foreach ($val['vod_play_list'] as $play) {
					foreach ($play['server_data'] as $p) {
						if ($play['server_name'] == 'nguon') {
							$n = $title . ' 1x' . $i;

							$cid = wp_insert_term($n, 'episodes');
							$cid = !is_wp_error($cid) ? intval($cid['term_id']) : intval($cid->error_data['term_exists']);

							wp_set_object_terms($post_id, $cid, 'episodes', true);
							$server1 = $wpdb->get_results("SELECT a.term_id  FROM `$wpdb->term_taxonomy` AS a JOIN `$wpdb->terms` AS b  ON a.term_id=b.term_id  WHERE a.taxonomy='server' AND b.name ='nguon'");
							$server2 = $wpdb->get_results("SELECT a.term_id  FROM `$wpdb->term_taxonomy` AS a JOIN `$wpdb->terms` AS b  ON a.term_id=b.term_id  WHERE a.taxonomy='server' AND b.name ='m3u8'");
							$quality = $wpdb->get_results("SELECT term_id  FROM `$wpdb->term_taxonomy` WHERE `taxonomy`='quality'");
							$lang = $wpdb->get_results("SELECT term_id  FROM `$wpdb->term_taxonomy` WHERE `taxonomy`='language'");
							$array_links = array(
								'type' => '1',
								'server' => $play['server_name'] == 'nguon' ? $server1[0]->term_id : $server2[0]->term_id,
								'lang' => isset($lang) ? $lang[0]->term_id : '',
								'quality' => isset($quality) ? $quality[0]->term_id : '',
								'link' => isset($p['link']) ? base64_encode(stripslashes(esc_textarea($p['link']))) : '',
								'date' => date('d') . '/' . date('m') . '/' . date('Y'),

							);
							$array_post_meta = array(

								'air_date' => isset($time) ? $time : '',
								'episode_number' => $i,
								'name' => 'Tập ' . $i,
								'overview' => '',
								'id' => '',
								'season_number' => 1,
								'still_path_hotlink' => $val['vod_pic'],
								'still_path' => '',
								'guest_stars' => '',
								'trglinks_0' => serialize($array_links),
								'trgrabber_tlinks' => '2',
								'tr_id_post' => $post_id,
							);
							foreach ($array_post_meta as $key => $value) {

								$new_meta_value = (isset($value) ? ($value) : '');
								$meta_value = is_array(get_term_meta($cid, $key, true)) ? array_map('stripslashes', get_term_meta($cid, $key, true)) : stripslashes(get_term_meta($cid, $key, true));

								if ($new_meta_value && '' == $meta_value) {
									add_term_meta($cid, $key, $new_meta_value, true);
								} elseif ($new_meta_value && $new_meta_value != $meta_value) {
									update_term_meta($cid, $key, $new_meta_value);
								} elseif ('' == $new_meta_value && $meta_value) {
									delete_term_meta($cid, $key, $meta_value);
								}
							}
							wp_update_term($cid, 'seasons', array(
								'name' => $title . ' 1x' . $i,
								'slug' => $slug . ' 1x' . $i
							));
							$i++;
						}
					}
				};

				// insert actor, director
				$actor = explode(',', $val['vod_actor']);
				$couuuu = count($actor);
				for ($ll = 0; $ll < $couuuu - 1; $ll++) {
					wp_set_object_terms($post_id, array('cast' => trim($actor[$ll])), 'cast', true);
				}
				wp_set_object_terms($post_id, array('directors' => $val['vod_director']), 'directors');
				wp_set_object_terms($post_id, array('country' => $val['vod_area']), 'country');
				wp_set_object_terms($post_id, array('release' => $val['vod_year']), 'release');
			}
		}
	}
	return ['code' => 1, 'msg' => $msg, 'postcount' => $post_count, 'saved_post' => $saved_post_count];
}

/**
 * pre handle data
 * @param {*} data
 * @returns {array}
 */
function pre_handle($data)
{
	if ($data['code'] > 1) {
		return;
	}
	$res_list = [];

	foreach ($data['list'] as $k => $v) {
		$v['vod_name'] = html_entity_decode($v['vod_name']);
		$v['vod_en'] = sanitize_title($v['vod_name']);
		$v['vod_letter'] = strtoupper(substr($v['vod_en'], 0, 1));
		$v['vod_class'] = mac_txt_merge($v['vod_class'], $v['type_name']);
		$v['vod_actor'] = mac_format_text($v['vod_actor']);
		$v['vod_director'] = mac_format_text($v['vod_director']);
		$v['vod_content'] = html_entity_decode($v['vod_content']);
		$v['vod_play_list'] = mac_play_list($v['vod_play_from'], $v['vod_play_note'], $v['vod_play_url']);
		$v['status'] = $v['vod_remarks'];
		$v['vod_year'] = ($v['vod_year'] == '' || $v['vod_year'] == 0) ? 'NA' : $v['vod_year'];

		unset($v['vod_time'], $v['vod_time_add'], $v['vod_weekday'], $v['vod_status']);
		unset($v['vod_hits'], $v['vod_hits_day'], $v['vod_hits_week'], $v['vod_hits_month']);
		unset($v['vod_up'], $v['vod_down'], $v['vod_score_num'], $v['vod_score_all'], $v['vod_score']);
		unset($v['group_id'], $v['vod_copyright'], $v['vod_duration'], $v['vod_lang']);
		unset($v['type_id'], $v['vod_author'], $v['vod_behind'], $v['vod_color'], $v['vod_douban_id'], $v['vod_douban_score']);
		unset($v['vod_down_from'], $v['vod_down_note'], $v['vod_down_server'], $v['vod_down_url']);
		unset($v['vod_id'], $v['vod_isend'], $v['vod_jumpurl'], $v['vod_level'], $v['vod_lock']);
		unset($v['vod_play_note'], $v['vod_play_server'], $v['vod_play_url'], $v['vod_play_from']);
		unset($v['vod_plot'], $v['vod_plot_detail'], $v['vod_plot_name']);
		unset($v['vod_pic_screenshot'], $v['vod_pic_thumb'], $v['vod_pubdate']);
		unset($v['vod_pwd'], $v['vod_pwd_down'], $v['vod_pwd_down_url'], $v['vod_pwd_play'], $v['vod_pwd_play_url'], $v['vod_pwd_url']);
		unset($v['vod_rel_art'], $v['vod_rel_vod'], $v['vod_reurl'], $v['vod_serial'], $v['vod_state'], $v['vod_sub'], $v['vod_tag']);
		unset($v['vod_total'], $v['vod_tpl'], $v['vod_tpl_down'], $v['vod_tpl_play'], $v['vod_trysee'], $v['vod_tv'], $v['vod_writer']);
		unset($v['vod_points'], $v['vod_points_down'], $v['vod_points_play'], $v['vod_time_hits'], $v['vod_time_make'], $v['vod_tv'], $v['vod_writer']);

		$res_list[$k] = $v;
	}
	return $res_list;
}


function mac_play_list($servers_str, $note, $urls_str)
{
	$server_add = array();
	$servers = explode($note, $servers_str);
	$urls = explode($note, $urls_str);
	foreach ( $servers as $key => $server_name ) {
		$server_info["server_name"] = $server_name == 'nguon' ? 'nguon' : 'm3u8';
		$server_info["server_data"] = array();
		$episodes = explode('#', $urls[$key]);

		foreach ($episodes as $key => $value) {
			list($episode, $url) = explode('$', $value);
			$ep_data['link'] = $url;
			$slug_name = str_replace("-", "_", sanitize_title(trim($episode)));
			$server_info["server_data"][$slug_name] = $ep_data;
		}
		array_push($server_add, $server_info);
	}
	return $server_add;
}

function mac_txt_merge($txt, $str)
{
	if (empty($str)) {
		return $txt;
	}
	$txt = mac_format_text($txt);
	$str = mac_format_text($str);
	$arr1 = $txt == "NA" ? [] : explode(',', $txt);
	$arr2 = explode(',', $str);
	$arr = array_merge($arr1, $arr2);
	return join(',', array_unique(array_filter($arr)));
}

function mac_format_text($str)
{
	if (empty($str)) {
		return "NA";
	}
	$str = str_replace(array('/', '，', '|', '、', ',,,'), ',', $str);
	$splt_str = explode(',', $str);
	foreach ($splt_str as &$val) {
		$val = ucwords(trim($val));
	}
	unset($val);
	return implode(',', $splt_str);
}

function checkUrl($url)
{
	$result = parse_url($url);
	if (empty($result['host']) || in_array($result['host'], ['127.0.0.1', 'localhost'])) {
		return ['code' => 1001, 'msg' => 'API liên kết sai hoặc không thể liên kết với localhost'];
	}
	return ['code' => 1];
}

function filter_tags($rs)
{
	$rex = array('{:', '<script', '<iframe', '<frameset', '<object', 'onerror');
	if (is_array($rs)) {
		foreach ($rs as $k2 => $v2) {
			if (!is_numeric($v2)) {
				$rs[$k2] = str_ireplace($rex, '*', $rs[$k2]);
			}
		}
	} else {
		if (!is_numeric($rs)) {
			$rs = str_ireplace($rex, '*', $rs);
		}
	}
	return $rs;
}
