<?php
session_start();
if (!isset($_SESSION['finance_manager_login'])) {
    header("location:index.php");
}

require __DIR__ . '/vendor/autoload.php';
include('include/connect.php');
include('include/custom.php');

use Spipu\Html2Pdf\Html2Pdf;
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
$date = date("d/m/y");
$specificBatch = fetchOtherdetails($con, 'students', 'batch', '34');
while ($standardData = mysqli_fetch_assoc($specificBatch)) {
    $exp_batch_id = explode(',', $standardData['batch']);
    foreach ($exp_batch_id as $bch_val) {
        $receptiion_email = '';

        // if (isset($_GET['id']) && isset($_GET['batch-id'])) {
        $studentId = $standardData['sno'];
        $batchId = $bch_val;
        // fetching student data
        $studentData = fetchOtherdetails($con, 'students', 'sno', $studentId);
        while ($show = mysqli_fetch_assoc($studentData)) {
            $name = $show['student_name'];
            $contact_no = $show['student_contact'];
            $feeAmount = $show['fees'];
            $registrationDate = $show['date'];
            $receptiion_email = $show['email'];
        }
        // fetching batch and course id
        $batchData = fetchOtherdetails($con, 'batch', 'batch_id', $batchId);
        while ($display = mysqli_fetch_assoc($batchData)) {
            $batchName = $display['batch_name'];
            $courseId = $display['course_id'];
        }
        $courseData = fetchOtherdetails($con, 'course', 'Id', $courseId);
        while ($look = mysqli_fetch_assoc($courseData)) {
            $courseName = $look['course_name'];
        }
        //fetching panelty amount
        $panelty = fetchAllData($con, 'panelty');
        while ($pn = mysqli_fetch_assoc($panelty)) {
            $pAmount = $pn['panelty'];
        }
        // Get the current timestamp
        //coverting date according to registration time starts here
        //first covert to strtotime
        $secDate = strtotime($registrationDate);
        $customDate = date('d/m/y', $secDate);
        $currentTimestamp = time();
        // Add 10 days to the current timestamp
        $newTimestamp = $currentTimestamp + (10 * 24 * 60 * 60);
        $singleDate = explode('/', $customDate);
        $sgDate = $singleDate[0];
        $currentMonthYear = date('m/y');
        $date__as__birth = $sgDate . '/' . $currentMonthYear;
        $increasedDate = IncreaseDate('d/m/y', $date__as__birth);
        // now taking challan number from student id from students fees table
        $c__month = date('F');
        $fee__info = fetchOtherdetailsCol3($con, 'students_fees', 'std_data', $studentId, 'batch_data', $batchId, 'month', $c__month);
        $challan_count = mysqli_num_rows($fee__info);
        while ($fee = mysqli_fetch_assoc($fee__info)) {
            $currentChallanNo = $fee['Id'];
        }

        // }

        try {
            $html2pdf = new Html2Pdf('L', 'A4');

            // $html2pdf->pdf->SetDisplayMode('fullpage');
            $data = '
    <table style="width: 100%;position:relative;top:7.2%;left:0.6%;">
    <tbody>
        <tr>
            <td style="width: 32%;text-align:center;border:1px dotted #000;padding-top:30px;margin-right:1%;">
               <img src="'.__DIR__.'/p-logo.png" alt="img">
               <table style="width:100%;"> <!-- Corrected syntax here -->
                    <tbody>
                        <tr>
                            <td style="width:50%;padding:10px; 5px"> <span style="font-weight:bold;">Dated : </span><span style="text-decoration:underline;">' . $date . '</span></td>
                            <td style="width:50%;padding:10px; 5px">
                            <span style="font-weight:bold;">Challan No :</span>
                            <span style="text-decoration:underline;">#' . $currentChallanNo . '-' . $challan_count . '</span>
                            </td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:100%;padding-bottom:6px;border-bottom:1px solid #000"> <!-- Corrected syntax here -->
                  <tbody>
                      <tr>
                          <td style="width:100%;text-align:center;"> 
                              <h4 style="text-align:center">Bank copy</h4>
                          </td>
                      </tr>
                  </tbody>
               </table>
               <table style="width:100%;margin:10px 0px;">
                    <tbody>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">Name : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $name . ' </td>
                        </tr>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">course : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $courseName . ' </td>
                        </tr>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">batch : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $batchName . '</td>
                        </tr>
                        <tr>
                           <td style="width:28%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">contact-no : </td>
                           <td style="width:72%;text-align:left;padding:6px 0px;">' . $contact_no . '</td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:95%;margin:10px 0px 10px 2.5%;border-collapse: collapse;" border="1px">
                    <tbody>
                        <tr>
                           <td style="width:70%;font-weight:bold;padding:10px 6px;text-align:left;">Description </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Amount </td>
                        </tr>
                        <tr>
                           <td style="width:70%;padding:10px 6px;text-align:left;">' . $courseName . ' monthly Fees</td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . $feeAmount . ' </td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:100%;margin:10px 0px 10px;padding:0px 2.5% 10px 2.5%;border-bottom:1px dotted #000;">
                    <tbody>
                        <tr>
                           <td style="width:70%;font-weight:bold;padding:10px 6px;text-align:left;">Payable due date (' . $increasedDate . ') </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . $feeAmount . '</td>
                        </tr>
                        <tr>
                           <td style="width:70%;padding:10px 6px;text-align:left;font-weight:bold;">Payable After date </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . ($feeAmount + $pAmount) . '</td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:95%;margin:15px 0px 15px 2.5%;border-collapse: collapse;">
                 <tbody>
                   <tr>
                      <td style="width:40%;text-align:left;">Payment Recieved
                      </td>
                      <td style="width:60%;border-bottom:1px solid #000;"> </td>
                   </tr>
                 </tbody>
               </table>
               <table style="width:95%;margin:15px 0px 15px 2.5%;border-collapse: collapse;">
                <tbody>
                  <tr>
                     <td style="width:40%;text-align:left;">Cashier Sign
                     </td>
                     <td style="width:60%;border-bottom:1px solid #000;"> </td>
                  </tr>
                </tbody>
               </table>
            </td>
            <td style="width: 32%;text-align:center;border:1px dotted #000;padding-top:30px;margin-right:1%;">
               <img src="'.__DIR__.'/p-logo.png" alt="img">
               <table style="width:100%;"> <!-- Corrected syntax here -->
                    <tbody>
                        <tr>
                            <td style="width:50%;padding:10px; 5px"> <span style="font-weight:bold;">Dated : </span><span style="text-decoration:underline;">' . $date . '</span></td>
                            <td style="width:50%;padding:10px; 5px">
                            <span style="font-weight:bold;">Challan No :</span>
                            <span style="text-decoration:underline;">#' . $currentChallanNo . '-' . $challan_count . '</span>
                            </td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:100%;padding-bottom:6px;border-bottom:1px solid #000"> <!-- Corrected syntax here -->
                <tbody>
                    <tr>
                        <td style="width:100%;text-align:center;"> 
                        <h4 style="text-align:center">Administator copy</h4>
                        </td>
                    </tr>
                </tbody>
               </table>
               <table style="width:100%;margin:10px 0px;">
                    <tbody>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">Name : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $name . ' </td>
                        </tr>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">course : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $courseName . ' </td>
                        </tr>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">batch : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $batchName . '</td>
                        </tr>
                        <tr>
                           <td style="width:28%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">contact-no : </td>
                           <td style="width:72%;text-align:left;padding:6px 0px;">' . $contact_no . '</td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:95%;margin:10px 0px 10px 2.5%;border-collapse: collapse;" border="1px">
                    <tbody>
                        <tr>
                           <td style="width:70%;font-weight:bold;padding:10px 6px;text-align:left;">Description </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Amount </td>
                        </tr>
                        <tr>
                           <td style="width:70%;padding:10px 6px;text-align:left;">' . $courseName . ' monthly Fees </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . $feeAmount . '</td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:100%;margin:10px 0px 10px;padding:0px 2.5% 10px 2.5%;border-bottom:1px dotted #000;">
                    <tbody>
                        <tr>
                        <td style="width:70%;font-weight:bold;padding:10px 6px;text-align:left;">Payable due date (' . $increasedDate . ') </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . $feeAmount . '</td>
                        </tr>
                        <tr>
                           <td style="width:70%;padding:10px 6px;text-align:left;font-weight:bold;">Payable After date </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . ($feeAmount + $pAmount) . '</td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:95%;margin:15px 0px 15px 2.5%;border-collapse: collapse;">
               <tbody>
                   <tr>
                      <td style="width:40%;text-align:left;">Payment Recieved
                      </td>
                      <td style="width:60%;border-bottom:1px solid #000;"> </td>
                   </tr>
               </tbody>
               </table>
               <table style="width:95%;margin:15px 0px 15px 2.5%;border-collapse: collapse;">
                <tbody>
                  <tr>
                     <td style="width:40%;text-align:left;">Cashier Sign
                     </td>
                     <td style="width:60%;border-bottom:1px solid #000;"> </td>
                  </tr>
                </tbody>
               </table>
            </td>
            <td style="width: 32%;text-align:center;border:1px dotted #000;padding-top:30px;margin-right:1%;">
               <img src="'.__DIR__.'/p-logo.png" alt="img">
               <table style="width:100%;"> <!-- Corrected syntax here -->
                    <tbody>
                        <tr>
                            <td style="width:50%;padding:10px; 5px"> <span style="font-weight:bold;">Dated : </span><span style="text-decoration:underline;">' . $date . '</span></td>
                            <td style="width:50%;padding:10px; 5px">
                            <span style="font-weight:bold;">Challan No :</span>
                            <span style="text-decoration:underline;">#' . $currentChallanNo . '-' . $challan_count . '</span>
                            </td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:100%;padding-bottom:6px;border-bottom:1px solid #000"> <!-- Corrected syntax here -->
                <tbody>
                    <tr>
                        <td style="width:100%;text-align:center;"> 
                            <h4 style="text-align:center">Student copy</h4>
                        </td>
                    </tr>
                </tbody>
               </table>
               <table style="width:100%;margin:10px 0px;">
                    <tbody>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">Name : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $name . ' </td>
                        </tr>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">course : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $courseName . ' </td>
                        </tr>
                        <tr>
                           <td style="width:25%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">batch : </td>
                           <td style="width:75%;text-align:left;padding:6px 0px;">' . $batchName . '</td>
                        </tr>
                        <tr>
                           <td style="width:28%;font-weight:bold;padding:6px 0px 6px 6px;text-align:left;">contact-no : </td>
                           <td style="width:72%;text-align:left;padding:6px 0px;">' . $contact_no . '</td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:95%;margin:10px 0px 10px 2.5%;border-collapse: collapse;" border="1px">
                    <tbody>
                        <tr>
                           <td style="width:70%;font-weight:bold;padding:10px 6px;text-align:left;">Description </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Amount </td>
                        </tr>
                        <tr>
                           <td style="width:70%;padding:10px 6px;text-align:left;">' . $courseName . ' monthly Fees</td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . $feeAmount . '</td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:100%;margin:10px 0px 10px;padding:0px 2.5% 10px 2.5%;border-bottom:1px dotted #000;">
                    <tbody>
                        <tr>
                        <td style="width:70%;font-weight:bold;padding:10px 6px;text-align:left;">Payable due date (' . $increasedDate . ') </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . $feeAmount . '</td>
                        </tr>
                        <tr>
                           <td style="width:70%;padding:10px 6px;text-align:left;font-weight:bold;">Payable After date </td>
                           <td style="width:30%;text-align:left;padding:10px 6px;text-align:right;">Rs.' . ($feeAmount + $pAmount) . '</td>
                        </tr>
                    </tbody>
               </table>
               <table style="width:95%;margin:15px 0px 15px 2.5%;border-collapse: collapse;">
               <tbody>
                   <tr>
                      <td style="width:40%;text-align:left;">Payment Recieved
                      </td>
                      <td style="width:60%;border-bottom:1px solid #000;"> </td>
                   </tr>
               </tbody>
               </table>
               <table style="width:95%;margin:15px 0px 15px 2.5%;border-collapse: collapse;">
                <tbody>
                  <tr>
                     <td style="width:40%;text-align:left;">Cashier Sign
                     </td>
                     <td style="width:60%;border-bottom:1px solid #000;"> </td>
                  </tr>
                </tbody>
               </table>
            </td>
            
        </tr>
    </tbody>
</table>

    ';

            // Make sure the image URL is correct and accessible

            $html2pdf->writeHTML($data);
            // $f_name = 'C:/xampp/htdocs/pixxel_house_lms/temporaryPdf.pdf';
            $f_name = __DIR__.'/temporaryPdf.pdf';
            $html2pdf->output($f_name, 'F');
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }




        // Server configuration (using Gmail SMTP)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587; // Use 465 for SSL
        $mail->SMTPSecure = 'tls'; // or 'ssl'
        $mail->SMTPAuth = true;

        // Use a secure alternative instead of "Less secure app access" if possible
        // e.g., App passwords: https://support.google.com/accounts/answer/186832
        // If you must use "Less secure app access", be aware of the risks:
        // https://support.google.com/accounts/answer/6020300

        // Replace with your Gmail address and a secure password
        $mail->Username = 'incredibleinfo333@gmail.com';
        $mail->Password = 'dego ajcg xmrc cvwc';


        //receptionist details
        $mail->addAddress($receptiion_email, $name); // Replace with your preferred sender details
        // Sender details
        $mail->setFrom('incredibleinfo333@gmail.com', 'Anas'); // Replace with your preferred sender details

        // Email content
        $mail->Subject = 'Email using pdf';
        $mail->Body = 'check the challan.';
        $mail->isHTML(false); // Set to true for HTML content
        // $filename = 'C:/xampp/htdocs/pixxel_house_lms/'.$f_name; // Replace with the actual path to your file
        $attachmentName = 'myfile.pdf'; // You can customize the displayed name of the attachment

        // Add the attachment using addAttachment($filePath, $fileName, $encoding, $mimeType)
        $mail->addAttachment(__DIR__.'/temporaryPdf.pdf', $attachmentName);
        try {
            $mail->send();
            echo 'Email sent successfully!';
            $mail->ClearAddresses();
            $mail->ClearAttachments();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }

        unlink($f_name);
    }
}
