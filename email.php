<?php 
                            $configMantanSource["EmailTransport"] = [
                                                            "default" => [
                                                                "host" => "ssl://smtp.gmail.com",
                                                                "port" => 465,
                                                                "username" => "mantansource@gmail.com",
                                                                "password" => "mantansource",
                                                                "className" => "Smtp",
                                                                "tls" => false,
                                                                "client" => null,
                                                                "url" => env("EMAIL_TRANSPORT_DEFAULT_URL", null),
                                                            ],
                                                        ];
                            ?>