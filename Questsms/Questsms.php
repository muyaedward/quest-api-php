<?php

/**
 * The MIT License
 *
 * Copyright 2014 Edward Muya Mwangi <muyaedward at gmail dot com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace Questsms;

/**
 * Quest Website Developers Ltd SMS Web Services
 *
 * @author Edward Muya Mwangi
 */
class Questsms {
	
	// Quest-web Web services operation results
	private $webservices_url;
	private $response;
	private $data;
	private $status;
	private $error;
	private $error_string;
	
	// Quest-web Web services operation parameters
	public $url;
	public $api_key;
	public $username;
	public $password;
	public $operation;
	public $from;
	public $to;
	public $footer;
	public $nofooter;
	public $msg;
	public $schedule;
	public $type;
	public $unicode;
	public $queue;
	public $src;
	public $dst;
	public $datetime;
	public $smslog_id;
	public $last_smslog_id;
	public $count;
	public $keyword;

	/**
	 * Fetch content from URL
	 *
	 * @param string $query_string
	 *        Webservices URL
	 */
	private function _Fetch() {
		$this->_setWebservicesUrl();
		
		$response = @file_get_contents($this->getWebservicesUrl());
		$this->response = $response;
	}

	/**
	 * Process and populate class for results
	 */
	private function _Populate() {
		$this->data = json_decode($this->response);
		
		// getStatus() FALSE upon receiving status ERR or a non-zero error
		// else set as TRUE
		if (is_array($this->data->data)) {
			$this->status = TRUE;
		} else {
			if (isset($this->data->status) && isset($this->data->error)) {
				if (($this->data->status == 'ERR') || ((int) $this->data->error > 0)) {
					$this->status = FALSE;
				} else {
					$this->status = TRUE;
				}
			} else {
				$this->status = FALSE;
			}
		}
		
		if (isset($this->data->error)) {
			$this->error = ((int) $this->data->error > 0 ? (int) $this->data->error : 0);
		} else {
			$this->error = 0;
		}
		
		if (isset($this->data->error_string)) {
			$this->error_string = $this->data->error_string;
		} else {
			$this->error_string = '';
		}
	}

	/**
	 * Build a complete webservices URL
	 */
	private function _setWebservicesUrl() {
		/*private function _setWebservicesUrl() {*/
		$ws_url = $this->url . '&format=json';
		
		if ($this->api_key) {
			$ws_url .= '&api_key=' . $this->api_key;
		}
		
		if ($this->username) {
			$ws_url .= '&username=' . $this->username;
		}
		
		if ($this->password) {
			$ws_url .= '&password=' . $this->password;
		}
		
		if ($this->operation) {
			$ws_url .= '&action=' . $this->operation;
		}
		
		if ($this->from) {
			$ws_url .= '&sender=' . urlencode($this->from);
		}
		
		if ($this->to) {
			$ws_url .= '&to=' . urlencode($this->to);
		}
			
		if ($this->msg) {
			$ws_url .= '&message=' . urlencode($this->msg);
		}
		
		if ($this->schedule) {
			$ws_url .= '&sendondate=' . $this->schedule;
		}
				
		$this->webservices_url = $ws_url;
		//return $this->webservices_url;
	}

	/**
	 * Get current webservices URL
	 *
	 * @return string
	 */
	public function getWebservicesUrl() {
		$this->_setWebservicesUrl();
		
		return $this->webservices_url;
	}

	/**
	 * Get raw response data from the server
	 *
	 * @return string
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * Get user's credit
	 *
	 * @return mixed
	 */
	public function getCredit() {
		$this->_Fetch();
		return $this->_Populate();
	}

	/**
	 * Send SMS to mobile numbers
	 *
	 * @return mixed
	 */

	public function sendSms() {
		$this->_Fetch();
		return $this->_Populate();
	}

}
