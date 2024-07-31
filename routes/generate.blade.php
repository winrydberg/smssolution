<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Appraisal</title>
    <style type="text/css">
        table{
           border: 1px solid black;width: 100%;
           border-collapse: collapse; 
        }
        td{
            border: 1px solid black;width: 100%;
        }
        .ft-check:before {
            content: "\e926";
            }
            *{
            font-family: 'DejaVu Sans';
            font-size: 12px;
        }
        .page-break {
        page-break-after: always;
       }

    </style>
</head>

<body>
    <div style="margin:auto">
      
          <img src="{{asset('assets/images/icon.png')}}" style="margin-left:45%;max-width:60px ">
          @if($this_year != null && $this_year->personal_info != null)

          <h3 style="text-align: center;"><span style="text-decoration: underline">UNIVERSITY OF GHANA </span><br><br>
            PERFORMANCE APPRAISAL FOR @if(in_array($this_year->personal_info->employment_type, [
            'SSN: NON-TECHNICAL',
            'SSN: NON-TECH CONTRA',
            'SS-PENSIONER CONT.',
            'SSN: TEACHING ASSIST',
            'SST: TECHNICAL',
            'SSN: TEACHING ASSIST',
            'SS: NON-TECHNICAL',
            'SS: CONTRACT TECH'
            ])) SENIOR STAFF @else JUNIOR STAFF @endif</h3>
            
             <p style="font-weight: bold;text-align: center;">(For the period 1st August {{(int)$this_year->entry_year-1}} to 31st July {{$this_year->entry_year}})</p>
            @endif
            <p style="font-weight: bold; text-transform:uppercase;">SECTION A. PERSONAL INFORMATION</p>
            <table>
                <tbody>
                    <tr>
                        <td colspan="2">SECTION A. PERSONAL INFORMATION</td>
                    </tr>
                    @if($this_year->personal_info != null)
                    <tr>
                        <td style="text-decoration: underline;">Surname</td>
                        <td>{{$this_year->personal_info->surname}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: underline;">Other Name(s)</td>
                        <td>{{$this_year->personal_info->othernames}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: underline;">Department</td>
                        <td>{{$this_year->personal_info->department}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">File No.</td>
                        <td>{{$this_year->personal_info->staff_id}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">College.</td>
                        <td>{{$this_year->personal_info->college}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">Previous Unit</td>
                        <td>{{$this_year->personal_info->previous_unit}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">Present Grade</td>
                        <td>{{$this_year->personal_info->present_grade}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">Employment Type</td>
                        <td>{{$this_year->personal_info->employment_type}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">Evaluation Period</td>
                        <td>{{$this_year->personal_info->evaluation_period}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">Date of First Appoinment</td>
                        <td>{{$this_year->personal_info->first_appointment_date}}</td>
                    </tr>

                    <tr>
                        <td style="text-decoration: none;">Date of Last Promotion</td>
                        <td>{{$this_year->personal_info->last_promotion_date}}</td>
                    </tr>
                    @else
                        <p>Section Not Completed</p>
                    @endif
                </tbody>
            </table>

            <p style="font-weight: bold; text-transform:uppercase;">SECTION B. &nbsp;&nbsp;&nbsp;TO BE COMPLETED BY STAFF / APPRAISEE</p>
            <table>
                <tbody>
                    <tr>
                        <td colspan="2">a. APPRAISERS INFORMATION</td>
                    </tr>
                    @if($this_year->appraisers != null)
                    <tr>
                        <td style="text-decoration: underline;">Current Supervisor ID</td>
                        <td>{{$this_year->appraisers->curr_supervisor_id}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: underline;">Current Supervisor Name</td>
                        <td>{{$this_year->appraisers->curr_supervisor_name}}</td>
                    </tr>

                    <tr>
                        <td style="text-decoration: underline;">Current HOD ID</td>
                        <td>{{$this_year->appraisers->curr_hod_id}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">Current HOD Name</td>
                        <td>{{$this_year->appraisers->curr_hod_name}}</td>
                    </tr>

                    <tr>
                        <td style="text-decoration: underline;">Previous Supervisor ID</td>
                        <td>{{$this_year->appraisers->prev_supervisor_id}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: underline;">Previous Supervisor Name</td>
                        <td>{{$this_year->appraisers->prev_supervisor_name}}</td>
                    </tr>

                    <tr>
                        <td style="text-decoration: underline;">Previous HOD ID</td>
                        <td>{{$this_year->appraisers->prev_hod_id}}</td>
                    </tr>
                    <tr>
                        <td style="text-decoration: none;">Previous HOD Name</td>
                        <td>{{$this_year->appraisers->prev_hod_name}}</td>
                    </tr>
                    @else
                    <p>Section Not Completed</p>
                    @endif
                </tbody>
            </table>


                <p style="font-weight: bold; text-transform:uppercase;">SECTION C - Job Targets/Objectives For the Current Year</p>
        
                <br> The appraiser and appraisee should meet to set performance targets/objectives for the year. This meeting should be held
        before the end of the second week in August.
        The targets/objectives should be reviewed periodically, and feedback provided to enable staff to achieve the set objectives.
        The targets/objectives should reflect the Unit’s/Department’s action plan in line with University/College Strategic Plan. The
        targets must be SMART (i.e. Specific, Measurable, Realistic, Agreeable, Timebound)</p>
        
        <div style="margin-top: 30px;">
            <table>
                    <thead>
                    <tr>
                        <th>Target</th>
                            <th>Projected Weight</th>
                            <th>Obtained Weight</th>
                            <th>Resources</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($this_year->objectives != null)
                        @foreach($this_year->objectives as $key => $ob)
                            <tr>
                                <td>{{$key+1}}. {{$ob->target}} </td>
                                <td> {{$ob->projected_weight}} </td>
                                <td> {{$ob->obtained_weight}} </td>
                                <td> {{$ob->resources}} </td>
                            </tr>
                        @endforeach
                        @else
                        <p>Section Not Completed</p>
                        @endif
                    </tbody>
            </table>
        </div>

            <p style="font-weight: bold;text-transform:uppercase;">SECTION D - Appraisee Conduct</p>
            
            <br> Employee conduct should contribute to the achievement of objectives/targets, facilitate teamwork, demonstrate, and uphold
    the core values of the University and provide memorable service experience to internal and external stakeholders.
    The following narratives should guide the assessment of employee’s conduct and work.</p>
            
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p><strong>EXCELLENT: - Exceeded the targets. Achieved over 100% of the targets.</strong></p>
                            <ul>
                                <li> Consistently performed beyond expectations in all key areas of objectives set.</li>
                                <li> Performance noticeably exceeded expectations.</li>
                                <li> An outstanding all-round performance.</li>
                                <li> Performance becomes a benchmark for others.</li>
                            </ul>
                        </td>
                        <td>
                            <p><strong>VERY GOOD: - Met the targets fully. Achieved 90-100% of the targets.</strong></p>
                            <ul>
                                <li> Fully met expectations in many all the objectives set.</li>
                                <li> Meets job requirements and often exceeds them.</li>
                                <li> Made significant impact.</li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p><strong>GOOD: - Met most of the targets. Achieved 70% to 89% of the targets</strong></p>
                            <ul>
                                <li> Met most targets set for the period in a satisfactory and adequate manner.</li>
                                <li> Recognized as important team member.</li>
                                <li> Meets and is above satisfactory performance standards at times.</li>
                                <li> Job performance is satisfactory, acceptable and sometimes above expectations</li>
                            </ul>
                        </td>
                        <td>
                            <p><strong>AVERAGE: - Met some of the targets. Achieved 50% to 69% of the targets</strong></p>
                            <ul>
                                <li> Met some objectives set but not all.</li>
                                <li> Partially successful</li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p><strong>BELOW AVERAGE: - Did not meet the targets. Achieved 40-49% of the targets.</strong></p>
                            <ul>
                                <li> Met less than half of objectives set</li>
                                <li> Objectives not consistently met</li>
                                <li> Improvement is needed to maintain current position</li>
                                <!-- <li> Job performance is satisfactory, acceptable and sometimes above expectations</li> -->
                            </ul>
                        </td>
                        <td>
                            <p><strong>UNSATISFACTORY: - Did not meet the targets. Achieved below 39% of the targets.</strong></p>
                            <ul>
                                <li> Failed to deliver to expected standards in key objective areas</li>
                                <li> Could not meet any of the targets</li>
                                <li> Performance requires a high degree of supervision and immediate corrective action.</li>
                                <li> Does not meet basic job requirements and immediate improvement is needed for employment to continue</li>

                            </ul>
                        </td>
                    </tr>

                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td>
                           <p><strong>WORK ATTENDANCE / PUNCTUALITY</strong></p>
                           <ul>
                                <li> Reports to work on time</li>
                                <li> Always available during working hours</li>
                           </ul>
                           <p><strong style="color:red;">SCORE: </strong> {{$this_year->conduct != null ? $this_year->conduct->work : 'Not Filled'}}</p>
                        </td>
                        <td>
                           <p><strong>TEAMWORK</strong></p>
                           <ul>
                                <li> Cooperates with persons in and outside the unit</li>
                                <li> Willingly accepts instructions and additional assignments</li>
                                <li> Assists others to accomplish group objective</li>
                           </ul>
                           <p><strong style="color:red;">SCORE: </strong> {{$this_year->conduct != null ? $this_year->conduct->teamwork : 'Not Filled'}}</p>
                        </td>
                    </tr>


                    <tr>
                        <td>
                           <p><strong>COMMITMENT TO SERVICE EXCELLENCE AND UNIVERSITY CORE VALUES</strong></p>
                           <ul>
                                <li> Respects superiors, colleagues, and customers</li>
                                <li> Demonstrates a high level of integrity and loyalty</li>
                                <li> Exhibits commitment to assigned job</li>
                                <li> Demonstrated behavior becomes a benchmark for others</li>
                           </ul>
                           <p><strong style="color:red;">SCORE: </strong> {{$this_year->conduct != null ? $this_year->conduct->commitment : 'Not Filled'}}</p>
                        </td>
                        <td>
                           <p><strong>CUSTOMER SERVICE</strong></p>
                           <ul>
                                <li> Ability to assist customers to find solutions to their problems</li>
                                <li> Go extra mile to offer support to customers</li>
                                <li> Respects and talks to customers politely</li>
                                <li> Ability to handle difficult customers</li>
                                <li> Willing to take time to answer questions or provide help to others</li>
                           </ul>
                           <p><strong style="color:red;">SCORE: </strong> {{$this_year->conduct != null ? $this_year->conduct->customer_service : 'Not Filled'}}</p>
                        </td>
                    </tr>


                    <tr>
                        <td>
                           <p><strong>PARTICIPATION IN CAPACITY BUILDING PROGRAMMES</strong></p>
                           <ul>
                                <li> Readily participates in training programmes</li>
                                <li> Transfers knowledge and competences acquired at training to the job</li>
                                <li> Takes time outside of work to improve skills</li>
                           </ul>
                           <p><strong style="color:red;">SCORE: </strong> {{$this_year->conduct != null ? $this_year->conduct->capacity_building : 'Not Filled'}}</p>
                        </td>
                        <td>
                           <p><strong>DEPENDABILITY</strong></p>
                           <ul>
                                <li> Reliable and trustworthy</li>
                                <li> Meets deadlines</li>
                                <li> Supports unit goals</li>
                           </ul>
                           <p><strong style="color:red;">SCORE: </strong> {{$this_year->conduct != null ? $this_year->conduct->dependability : 'Not Filled'}}</p>
                        </td>
                    </tr>


                    <tr>
                        <td>
                           <p><strong>COMMUNICATION</strong></p>
                           <ul>
                                <li> Ability to network and relate to other workers across departments</li>
                                <li> Effectively communicates decisions and requests</li>
                                <li> Ability to comprehend and execute assignments without difficulty</li>
                                <li> Has the ability to clearly express ideas to others</li>
                           </ul>
                           <p><strong style="color:red;">SCORE: </strong> {{$this_year->conduct != null ? $this_year->conduct->communication : 'Not Filled'}}</p>
                        </td>
                        <td>
                           <p><strong>INNOVATION</strong></p>
                           <ul>
                                <li> Always displays innovation, and imagination in improving work methods</li>
                                <li> Utilize technology (or other effective ways) to improve work outputs</li>
                                <!-- <li> Supports unit goals</li> -->
                           </ul>
                           <p><strong style="color:red;">SCORE: </strong> {{$this_year->conduct != null ? $this_year->conduct->innovation : 'Not Filled'}}</p>
                        </td>
                    </tr>

                </tbody>
            </table>


            <p style="font-weight: bold;text-transform:uppercase;">SECTION E - Overall Evaluation Of Appraisee</p>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <p><strong>WORK</strong> <strong style="color:red;">{{$this_year->conduct != null ? $this_year->conduct->overall_work : "Not Filled"}}</strong></p>
                            <ul>
                                <li>Excellent (90–100%) @if(!is_null($this_year->conduct) && $this_year->conduct->work_eval == "Excellent") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Very Good (75–89%) @if(!is_null($this_year->conduct) && $this_year->conduct->work_eval == "Very Good") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Good (60–74%) @if(!is_null($this_year->conduct) && $this_year->conduct->work_eval == "Good") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Average (50–59%) @if(!is_null($this_year->conduct) && $this_year->conduct->work_eval == "Average") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Below Average (40–49%) @if(!is_null($this_year->conduct) && $this_year->conduct->work_eval == "Below Average") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Unsatisfactory (below 40%) @if(!is_null($this_year->conduct) && $this_year->conduct->work_eval == "Unsatisfactory") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p><strong>CONDUCT</strong> <strong style="color:red;">{{$this_year->conduct != null ? $this_year->conduct->overall_conduct : "Not Filled"}}</strong></p>
                            <ul>
                                <li>Excellent (90–100%) @if(!is_null($this_year->conduct) && $this_year->conduct->overall_conduct_eval == "Excellent") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Very good (75–89%) @if(!is_null($this_year->conduct) && $this_year->conduct->overall_conduct_eval == "Very Good") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Good (60–74%) @if(!is_null($this_year->conduct) && $this_year->conduct->overall_conduct_eval == "Good") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Average (50–59%) @if(!is_null($this_year->conduct) && $this_year->conduct->overall_conduct_eval == "Average") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Below Average (40–49%) @if(!is_null($this_year->conduct) && $this_year->conduct->overall_conduct_eval == "Below Average") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                                <li>Unsatisfactory (below 40%) @if(!is_null($this_year->conduct) && $this_year->conduct->overall_conduct_eval == "Unsatisfactory") <span style="height: 5px; width:5px; background-color:red;"></span> @endif</li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p><strong>SPECIFIC DETAILS:</strong> </p>
                            <p>Please give specific examples of outstanding, below average or unsatisfactory work and/or conduct in the section below.
Letters of commendation or warning/caution should be attached.</p>
                            <p></p>
                        </td>
                    </tr>

                    

                </tbody>
            </table>


            <p style="font-weight: bold; text-transform:uppercase;">SECTION G - Setting Job Objectives/Targets for Next Year</p>
            <p>The supervisor and employee shall engage in a collegial dialogue to set key job objectives/targets against which employee
performance will be evaluated at the end of the next appraisal year</p>

            <div style="margin-top: 30px;">
                <table>
                        <thead>
                        <tr>
                            <th>Target</th>
                            <th>Projected Weight</th>
                            <th>Obtained Weight</th>
                            <th>Resources</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($this_year->next_year_targets != null)
                            @foreach($this_year->next_year_targets as $key => $ob)
                                <tr>
                                    <td>{{$key+1}}. {{$ob->target}} </td>
                                    <td> {{$ob->projected_weight}} </td>
                                    <td> N/A </td>
                                    <td> {{$ob->resources}} </td>
                                </tr>
                            @endforeach
                            @else
                            <p>Section NOT Completed</p>
                            @endif
                        </tbody>
                </table>
            </div>

            <br>
            <br>
            <p style="font-weight: bold; text-transform:uppercase;">SECTION H - Training & Development Needs</p>
            <p>[ To be completed by the appraiser in discussion with the appraisee ]</p>
            <p>With reference to the performance evaluation and job description what competencies/skills does the employee lack, which
contributed to his/her inability to meet all the targets or will enhance the performance of the employee?</p>

            <p></p>

            <table>
                <tbody>
                    <tr>
                        <td>
                           <p> Have you had any training(s) in the past year? <strong style="color:red">{{$this_year->had_training}}</strong></p>
                        </td>
                    </tr>

                    @if($this_year->had_training == "YES")
                        @foreach($this_year->training_dev as $key => $t)
                        <tr>
                            <td>
                            <p>{{$key+1}}. {{$t->area}}</p> 
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>


            <br>
            <br>
            <p style="font-weight: bold; text-transform:uppercase;">SECTION I - Signature(s),</p>
            <p>[ To be completed by Both AppraiserF Appraisee And HOD]</p>
            <p>With reference to the performance evaluation and job description what competencies/skills does the employee lack, which
contributed to his/her inability to meet all the targets or will enhance the performance of the employee?</p>

            <p></p>

            <table>
                <tbody>
                    
                    <tr>
                        <td>
                            <p><strong style="color:red;">APPRAISEE</strong></p>
                            <p>NB: </p>
                           <ul>
                            <li> I received a copy of my job description prior to setting performance targets/objectives.: <strong style="color:red">{{$this_year != null ? ($this_year->received_job_desc==1 ? "YES" : "NO") : "NO"}}</strong></li>
                            <li> I received the required resources to enable me to achieve my performance targets : <strong style="color:red">{{$this_year != null ? ($this_year->received_resources==1 ? "YES" : "NO") : "NO"}}</strong></li>
                            <li> I agree with the content and overall appraisal score of my performance. If “No” complete the comment section. : <strong style="color:red">{{$this_year != null ? ($this_year->agreed==1 ? "YES" : "NO") : "NO"}}</strong></li>
                           </ul>

                           <p><strong>COMMENTS: </strong>  </p>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <p><strong style="color:red;">SUPERVISOR / APPRAISER </strong></p>
                           <ul>
                                <li> I declare that this report reflects my candid evaluation of the employee’s performance in the year under review. I also
    acknowledge that I engaged the appraisee in a review dialogue and agreed on the final rating with reference to the
    achievement of each target set and the job description for the role. I hereby submit to Head of Department for further
    review.</li>
                                @if($this_year->appraisers != null)
                                <li> <strong>Staff Name:</strong> {{$this_year->appraisers->curr_supervisor_name}}</li>
                                <li> <strong>Staff ID:</strong> {{$this_year->appraisers->curr_supervisor_id}} </li>
                                <li> <strong>Signed:</strong> {{$this_year->superv_signature_filled == 1 ? "YES" : "NO"}} </li>
                                <li> <strong>Date Signed:</strong> {{$this_year->supervisor_sign_date}}</li>
                                @else
                                <li> <strong>N/A</strong> </li>
                                @endif
                           </ul>

                           <p><strong>COMMENTS: </strong>  </p>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <p><strong style="color:red;"> HOD SIGNATURE </strong></p>
                           <ul>
                                <li> I reviewed this appraisal report with the supervisor to ensure that the appraisal process and dialogue were duly followed
prior to issuance to the employee. By signature, I confirm that the overall assessment scores reflect the performance of
appraisee with respect to the achievement of performance objectives and contribution to the achievement of University/College strategic objectives.</li>
                            @if($this_year->appraisers != null)
                                <li> <strong>Staff Name:</strong> {{$this_year->appraisers->curr_hod_name}}</li>
                                <li> <strong>Staff ID:</strong> {{$this_year->appraisers->curr_hod_id}}</li>
                                <li> <strong>Signed:</strong> {{$this_year->hod_signature_filled == 1 ? "YES" : "NO"}}</li>
                                <li> <strong>Date Signed:</strong> {{$this_year->hod_sign_date}}</li>
                            @else
                                <li> <strong>N/A</strong> </li>
                            @endif
                           </ul>

                           <p><strong>COMMENTS: </strong>  </p>
                        </td>
                    </tr>


                </tbody>
            </table>




    </div>
</body>

</html>