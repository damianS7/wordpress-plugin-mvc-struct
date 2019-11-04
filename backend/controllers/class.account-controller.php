<?php

class PluginName_Backend_AccountController {
    public function view_accounts() {
        $data = array('success_message' => 'view loaded!');
        return PluginName_Backend::view('accounts.php', $data);
    }
}
