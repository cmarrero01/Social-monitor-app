<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
$this->_ci = & get_instance();
$this->_ci->load->model('configuration_model');
$conf = $this->_ci->configuration_model->get_configurations();
// required only for streaming api
$config['user'] = (isset($conf['twitter']->username))?$conf['twitter']->username:'';
$config['pass'] = (isset($conf['twitter']->password))?$conf['twitter']->password:'';

// required only for api v1.1 search
$config['consumer_token']  = (isset($conf['twitter']->consumer_key))?$conf['twitter']->consumer_key:'';
$config['consumer_secret'] = (isset($conf['twitter']->consumer_secret))?$conf['twitter']->consumer_secret:'';
$config['access_token']    = (isset($conf['twitter']->access_token))?$conf['twitter']->access_token:'';
$config['access_secret']   = (isset($conf['twitter']->access_token_secret))?$conf['twitter']->access_token_secret:'';

$config['twitter_consumer_token']		= (isset($conf['twitter']->consumer_key))?$conf['twitter']->consumer_key:'';
$config['twitter_consumer_secret']		= (isset($conf['twitter']->consumer_secret))?$conf['twitter']->consumer_secret:'';
$config['twitter_access_token']			= (isset($conf['twitter']->access_token))?$conf['twitter']->access_token:'';
$config['twitter_access_secret']		= (isset($conf['twitter']->access_token_secret))?$conf['twitter']->access_token_secret:'';

/* End of file twitter.php */
/* Location: ./application/config/twitter.php */