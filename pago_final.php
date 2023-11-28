<?php

$data = '{
    "id": "EB_M-RNy7pPzzAhZdzHD7xZVjIO4K32V8-PrMvPvHjTHV5XrwiwgR-Ym4e9b4sGzduLFARikCsoHkg_Z",
    "status": "COMPLETED",
    "payment_source": {
        "card": {
            "last_digits": "6889",
            "brand": "VISA",
            "type": "CREDIT"
        }
    },
    "purchase_units": [
        {
            "reference_id": "default",
            "payments": {
                "captures": [
                    {
                        "id": "2FB04508RA686960W",
                        "status": "DECLINED",
                        "amount": {
                            "currency_code": "USD",
                            "value": "500.00"
                        },
                        "final_capture": true,
                        "disbursement_mode": "INSTANT",
                        "seller_protection": {
                            "status": "NOT_ELIGIBLE"
                        },
                        "seller_receivable_breakdown": {
                            "gross_amount": {
                                "currency_code": "USD",
                                "value": "500.00"
                            },
                            "paypal_fee": {
                                "currency_code": "USD",
                                "value": "13.44"
                            },
                            "net_amount": {
                                "currency_code": "USD",
                                "value": "486.56"
                            }
                        },
                        "links": [
                            {
                                "href": "https://api-m.sandbox.paypal.com/v2/payments/captures/2FB04508RA686960W",
                                "rel": "self",
                                "method": "GET"
                            },
                            {
                                "href": "https://api-m.sandbox.paypal.com/v2/payments/captures/2FB04508RA686960W/refund",
                                "rel": "refund",
                                "method": "POST"
                            },
                            {
                                "href": "https://api-m.sandbox.paypal.com/v2/checkout/orders/3M049991JF5624929",
                                "rel": "up",
                                "method": "GET"
                            }
                        ],
                        "create_time": "2022-08-09T22:20:05Z",
                        "update_time": "2022-08-09T22:20:05Z",
                        "processor_response": {
                            "avs_code": "G",
                            "cvv_code": "P",
                            "response_code": "5400"
                        }
                    }
                ]
            }
        }
    ],
    "links": [
        {
            "href": "https://api-m.sandbox.paypal.com/v2/checkout/orders/3M049991JF5624929",
            "rel": "self",
            "method": "GET"
        }
    ]
}';


echo $data;

?>
