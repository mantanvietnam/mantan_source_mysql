<?php 
$configMantanSource["EmailTransport"] = [
                                            "default" => [
                                                "host" => "ssl://smtp.gmail.com",
                                                "port" => 465,
                                                "username" => "tranmanhbk179@gmail.com",
                                                "password" => "umorvuwtejpalbss",
                                                "className" => "Smtp",
                                                "tls" => true,
                                                "client" => null,
                                                "url" => env("EMAIL_TRANSPORT_DEFAULT_URL", null),
                                            ],
                                        ];
?>