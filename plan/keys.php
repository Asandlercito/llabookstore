<?php
/**
 * Get the client
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Define configuration
 */

/* Username, password and endpoint used for server to server web-service calls */
Lyra\Client::setDefaultUsername("80247828");
Lyra\Client::setDefaultPassword("prodpassword_36WvLliGty7TfiuPrMRjnYtQcPbUPFqxbSOlZpK6gg0t5");
Lyra\Client::setDefaultEndpoint("https://api.micuentaweb.pe");

/* publicKey and used by the javascript client */
Lyra\Client::setDefaultPublicKey("80247828:publickey_1QGTVNmroGkkRbUKyrZuR4Zi6EhfMYRXhbspkMTTmSWIf");

/* SHA256 key */
Lyra\Client::setDefaultSHA256Key("ccyimDXJGSfvTgx47BcdcJbgkskmme72qlRbCL7XqWyv1");