<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->

    <!-- Your title goes here -->
    <title>Newsletter</title>
    <!-- End title -->

    <!-- Start stylesheet -->
    <style type="text/css">
        a,
        a[href],
        a:hover,
        a:link,
        a:visited {
            /* This is the link colour */
            text-decoration: none !important;
            color: #0000EE;
        }

        .link {
            text-decoration: underline !important;
        }

        p,
        p:visited {
            /* Fallback paragraph style */
            font-size: 15px;
            line-height: 24px;
            font-family: 'Helvetica', Arial, sans-serif;
            font-weight: 300;
            text-decoration: none;
            color: #000000;
            margin: 0;
            /* Remove default margin */
            padding: 0;
            /* Remove default padding */
        }

        h1 {
            /* Fallback heading style */
            font-size: 22px;
            line-height: 24px;
            font-family: 'Helvetica', Arial, sans-serif;
            font-weight: normal;
            text-decoration: none;
            color: #000000;
            margin: 0;
            /* Remove default margin */
            padding: 0;
            /* Remove default padding */
        }

        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td {
            line-height: 100%;
        }

        .ExternalClass {
            width: 100%;
        }
    </style>
    <!-- End stylesheet -->
    <style>
        * {
            background-color: gainsboro;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>


<!-- You can change background colour here -->

<body style=" text-align: center; margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: gainsboro; color: #331938" align="center">

    <!-- Fallback force center content -->
    <div style="text-align: center;">
        <!-- Start container for logo -->
        <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px;" width="600px">
            <tbody>
                <tr>
                    <td style="width: 596px; vertical-align: top; padding-left: 95px; padding-right: 0; padding-top: 15px; padding-bottom: 15px;" width="596px">

                        <!-- Your logo is here -->
                        <img style="width: 180px; max-width: 180px; height: 85px; max-height: 85px; text-align: center; color: #ffffff;" alt="Logo" src="https://images.squarespace-cdn.com/content/v1/5f997ef94da0c64db54c7a8f/1606126031006-2Q0O27XG4KGW3N3IKELQ/logo_SCARABEOCAMP_black.png?format=1500w" align="center" width="180" height="85">

                    </td>

                </tr>
            </tbody>
        </table>
        <!-- End container for logo -->


        <!-- Start image -->
        <img style="width: 1000px; max-width: 1000px; height: 240px; max-height: 240px; text-align: center;" alt="Image" src="https://www.inaracamp.com/wp-content/uploads/2020/09/inara-camp-cochlea-178-2.jpg" align="center" width="600" height="240">
        <!-- End image -->


        <!-- Start heading for double column section -->
        <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 500px;" width="600">
            <tbody>
                <tr>
                    <td style="width: 700px; vertical-align: top; padding-left: 50px; padding-right: 30px; padding-top: 30px; padding-bottom: 0;" width="500">
                        <table width="100%" style="border-collapse: collapse; border: 2px solid; padding: 0 5px;" class="font">
                            <thead class="table-light">
                                <tr>
                                    <th style="padding: 10px; border: 2px solid ;">hut Type</th>
                                    <th style="padding: 10px; border: 2px solid ;">Total hut</th>
                                    <th style="padding: 10px;border: 2px solid ;">Price</th>
                                    <th style="padding: 10px;border: 2px solid ;">Check In / Out Date</th>
                                    <th style="padding: 10px;border: 2px solid ;">Total Days</th>
                                    <th style="padding: 10px;border: 2px solid ;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 10px;border: 2px solid ;">{{ $editData->hut->type->name }}</td>
                                    <td style="padding: 10px;border: 2px solid ;">{{ $editData->number_of_huts }}</td>
                                    <td style="padding: 10px;border: 2px solid ;">${{ $editData->actual_price }}</td>
                                    <td style="padding: 10px;border: 2px solid ;">
                                        <span class="badge bg-primary">{{ $editData->check_in }}</span> /<br>
                                        <span class="badge bg-warning text-dark">{{ $editData->check_out }}</span>
                                    </td>
                                    <td style="padding: 10px;border: 2px solid ;">{{ $editData->total_night }}</td>
                                    <td style="padding: 10px;border: 2px solid ;">${{ $editData->actual_price * $editData->number_of_huts }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        </br>

        <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px;" width="600">
            <tbody>
                <tr>
                    <td style="width: 700px; vertical-align: top; padding-left: 50px; padding-right: 30px; padding-top: 30px; padding-bottom: 0;" width="596">
                        <table width="100%" style="border-collapse: collapse; border: 2px solid;  padding: 0 5px;" class="font">
                            <thead class="table-light">
                                <tr>
                                    <th style="padding: 30px; border: 2px solid;">Description</th>
                                    <th style="padding: 30px; border: 2px solid;">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 10px 30px; border: 2px solid;">Subtotal</td>
                                    <td style="padding: 10px 30px; border: 2px solid;">${{ $editData->subtotal }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 30px; border: 2px solid;">Discount</td>
                                    <td style="padding: 10px 30px; border: 2px solid;">${{ $editData->discount }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 30px; border: 2px solid;">Grand Total</td>
                                    <td style="padding: 10px 30px; border: 2px solid;">${{ $editData->total_price }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>

                </tr>
                <td style="width: 50%; vertical-align: top; padding-left: 15px; padding-right: 30px; padding-top: 30px; padding-bottom: 30px;" width="50%">
                    <pre class="font" style="margin: 0; padding: 0;">
                       SCARABEO  Head Office
                       Email: support@scarabeo.com <br>
                       Mob: 1245454545 <br>
                       Agadir 1207, Block: #4 <br>
                        </pre>
                </td>
            </tbody>
        </table>


        <!-- End heading for double column section -->


        <!-- End footer -->

    </div>

</body>

</html>