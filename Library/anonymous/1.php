<?php

// echo preg_replace_callback('~-([a-z])~', function ($match) {
//     return strtoupper($match[1]);
// }, 'hello-world');
// // outputs helloWorld


// $greet = function($name)
// {
//     printf("Hello %s\r\n", $name);
// };
// $greet('World');
// $greet('PHP');





// $callback =
//     function ($quantity, $product) use ($tax, &$total)
//     {
//         $pricePerItem = constant(__CLASS__ . "::PRICE_" .
//             strtoupper($product));
//         $total += ($pricePerItem * $quantity) * ($tax + 1.0);
//     };

// array_walk($this->products, $callback);

// interface Friends {

// }

class User {

	pirvate $info;

	public function __construct($user, $all = true) {
		if (is_array($user)) {
			$this->info = $user;
			$this->id = $user['id'];
		} else {
			if ($all) {

			} else {
				$this->id = $user;
			}
		} 
	}

	public function getInfo() {
		return $this->info;
	}

	public function getFriendInfo($friendId) {
		 $result = Server::call('Mbs.User.getFriendData', $this->info['id'], $friendId);
		 return $result;
	}

	public function focus($toUser) {
	  	//更新数据库
		$focusArr = array(
		    'from_user' => $fromUser,
		    'to_user' => $toUser,
		);
		$result = Server::call('Mbs.Friends.focus', $focusArr);

		 if (!isset($result['code']) || $result['code'] != 0 || $result['data'] !== true) {
            return false;
        }
        //将关注消息存入redis，用于push向被关注者
        // self::pushFocusNotice($fromUser, $toUser);
        return true;
	}



}