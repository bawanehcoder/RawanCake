<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقديم طلب توظيف</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-purple: #9B6B9D;
            --secondary-purple: #8A5A8C;
            --white: #FFFFFF;
            --text-dark: #333333;
            --border-color: #CCCCCC;
            --gradient-start: #FFE6F3;
            --gradient-end: #F8D7E5;
        }
        body {
    margin: 0;
    min-height: 100vh;
    font-family: 'Amiri', serif;
    padding: 2rem 1rem;
    color: var(--text-dark);
    background-image: url('https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Download%20premium%20image%20of%20Hand%20drawn%20cakes%20frame%20design%20element%20by%20katie%20about%20background,%20frame,%20art,%20vintage,%20and%20illustration%202416218.jpg-kU5itiERByfVFClIo1ZyGwEM2NfTty.jpeg');
    background-repeat: repeat;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
}

/* Adjust container background to be slightly more opaque to ensure form readability */
.container {
    max-width: 800px;
    margin: 0 auto;
    background: linear-gradient(135deg, rgba(255, 246, 230, 0.95), rgba(255, 230, 243, 0.95), rgba(240, 230, 255, 0.95));
    border-radius: 50px;
    padding: 2.5rem;
    box-shadow: 0 15px 30px rgba(155, 107, 157, 0.2);
    position: relative;
    overflow: hidden;
}

select option:first-child {
    color: #666;
    font-style: italic;
}


        /* .container {
            max-width: 800px;
            margin: 0 auto;
            background: linear-gradient(135deg, #FFF6E6, #FFE6F3, #F0E6FF);
            border-radius: 50px;
            padding: 2.5rem;
            box-shadow: 0 15px 30px rgba(155, 107, 157, 0.2);
            position: relative;
            overflow: hidden;
        } */

        .header {
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 2rem;
            border-bottom: 2px dashed var(--primary-purple);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header img {
            width: 150px;
            height: auto;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }

        .header h1 {
            color: var(--primary-purple);
            font-size: 2.5rem;
            margin: 0;
            position: relative;
            display: inline-block;
        }

        .step-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2rem 0;
            position: relative;
        }

        .step-container::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border-color);
            z-index: 1;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--white);
            border: 2px solid var(--border-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            color: var(--text-dark);
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
            margin: 0 20px;
        }

        .step.active {
            background: var(--primary-purple);
            border-color: var(--primary-purple);
            color: var(--white);
            transform: scale(1.2);
        }

        fieldset {
            border: none;
            display: none;
            background: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 15px;
            margin: 2.5rem 0 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            position: relative;
        }

        fieldset.active {
            display: block;
            animation: slideIn 0.4s ease-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        legend {
            font-size: 1.5rem;
            color: var(--text-dark);
            font-weight: bold;
            margin-bottom: 1.5rem;
            width: auto;
            padding: 10px 20px;
            position: relative;
            background-color: var(--white);
            border-radius: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        legend::before,
        legend::after {
            content: '';
            position: absolute;
            border-radius: 50%;
        }

        legend::before {
            width: 30px;
            height: 30px;
            top: -10px;
            left: -15px;
        }

        legend::after {
            width: 40px;
            height: 40px;
            bottom: -15px;
            right: -20px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        label {
            display: block;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input, select, textarea {
    width: 100%;
    padding: 0.5rem 0.8rem; 
    border: 2px solid transparent;
    border-radius: 8px;
    font-family: 'Amiri', serif;
    font-size: 1.5rem; 
    color: var(--text-dark);
    background: linear-gradient(var(--white), var(--white)) padding-box,
                linear-gradient(45deg, var(--primary-purple), var(--secondary-purple)) border-box;
    transition: all 0.3s ease;
    box-sizing: border-box;
    height: auto; 
    line-height: 1.5; 
}

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: transparent;
            box-shadow: 0 0 0 3px rgba(155, 107, 157, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
            height: auto;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            gap: 1rem;
        }

        button {
            background: linear-gradient(45deg, var(--primary-purple), var(--secondary-purple));
            color: var(--white);
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-family: 'Amiri', serif;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(155, 107, 157, 0.3);
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: translateX(-100%);
            transition: 0.5s;
        }

        button:hover::before {
            transform: translateX(100%);
        }

        button[type="submit"] {
            background: linear-gradient(45deg, var(--secondary-purple), var(--primary-purple));
        }

        button[type="submit"]:hover {
            background: linear-gradient(45deg, var(--primary-purple), var(--secondary-purple));
        }

        .photo-container {
            position: relative;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            border: none;
            background: linear-gradient(var(--white), var(--white)) padding-box,
                        linear-gradient(45deg, var(--primary-purple), var(--secondary-purple)) border-box;
            padding: 4px;
            margin: 0 auto 1.5rem;
            box-shadow: 0 6px 15px rgba(155, 107, 157, 0.2);
        }

        .photo-container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 50%;
            border: 2px solid transparent;
            background: linear-gradient(45deg, var(--primary-purple), var(--secondary-purple)) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, 
                          linear-gradient(#fff 0 0);
            mask: linear-gradient(#fff 0 0) padding-box, 
                  linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
            }

            .header h1 {
                font-size: 2rem;
            }

            fieldset {
                padding: 1.5rem;
            }

            .buttons {
                flex-direction: column;
            }

            button {
                width: 100%;
            }
        }

        .agreement-group {
            display: flex;
            align-items: flex-start;
        }

        .agreement-label {
            display: flex;
            align-items: flex-start;
            font-size: 0.9rem;
            line-height: 1.2;
            cursor: pointer;
        }

        .checkmark {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-left: 10px;
            border: 2px solid var(--primary-purple);
            border-radius: 4px;
            position: relative;
        }

        #agree {
            display: none;
        }

        #agree:checked + .agreement-label .checkmark::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--primary-purple);
            font-weight: bold;
        }

        .agreement-text {
            flex: 1;
        }
    </style>
</head>
<body>
    <form id="jobForm" method="post" action="{{ route('job-application.store') }}" enctype="multipart/form-data">
        @csrf

    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/images/logoo.png') }}" alt="وصف الصورة" style="max-width: 100%; height: auto;">

            <h1>تقديم طلب توظيف</h1>
        </div>

        <div class="step-container">
            <div class="step active">1</div>
            <div class="step">2</div>
            <div class="step">3</div>
            <div class="step">4</div>
        </div>

        {{-- <form id="jobForm" method="post" action="" enctype="multipart/form-data" >
            @csrf --}}
            <fieldset class="active">
                <legend>البيانات الشخصية</legend>

                <div class="form-group">
                    <label for="photo">الصورة الشخصية:</label>
                    <div class="photo-container">
                        <img id="photoPreview" src="" alt="الصورة الشخصية">
                    </div>
                    <input type="file" name="photo" id="photo" required accept="image/*">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="full_name">الاسم الرباعي:</label>
                        <input type="text" name="full_name" id="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="nationality">الجنسية:</label>
                        <input type="text" name="nationality" id="nationality" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="birthplace">مكان الولادة:</label>
                        <input type="text" name="birthplace" id="birthplace">
                    </div>
                    <div class="form-group">
                        <label for="dob">تاريخ الولادة:</label>
                        <input type="date" name="dob" id="dob" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="national_id">الرقم الوطني:</label>
                        <input type="text" name="national_id" id="national_id">
                    </div>
                    <div class="form-group">
                        <label for="gender">الجنس:</label>
                        <select name="gender" id="gender" required>
                            <option value="">اختر...</option>
                            <option value="male">ذكر</option>
                            <option value="female">أنثى</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="smoker">هل أنت مدخن؟</label>
                        <select name="smoker" id="smoker" required>
                            <option value="">اختر...</option>
                            <option value="yes">نعم</option>
                            <option value="no">لا</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currently_employed">هل أنت على رأس عملك؟</label>
                        <select name="currently_employed" id="currently_employed" required>
                            <option value="">اختر...</option>
                            <option value="yes">نعم</option>
                            <option value="no">لا</option>
                        </select>
                    </div>
                </div>

                <div class="buttons">
                    <button type="button" id="next1">التالي</button>
                </div>
            </fieldset>

            <fieldset>
                <legend>بيانات الاتصال</legend>
                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">رقم الهاتف:</label>
                        <input type="text" name="phone" id="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">عنوان البريد الإلكتروني:</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">عنوان السكن الدائم:</label>
                    <input type="text" name="address" id="address">
                </div>

                <div class="buttons">
                    <button type="button" id="prev2">السابق</button>
                    <button type="button" id="next2">التالي</button>
                </div>
            </fieldset>

            <fieldset>
                <legend>المؤهلات العلمية</legend>
                <div class="form-row">
                    <div class="form-group">
                        <label for="qualification">المؤهل العلمي:</label>
                        <select name="qualification" id="qualification" required>
                            <option value="" disabled selected>اختر المؤهل العلمي</option>
                            <option value="ثانوية عامة ناجح">الثانوية العامة ناجح</option>
                            <option value="ثانوية عامة راسب">الثانوية العامة راسب</option>
                            <option value="جامعة">جامعة</option>
                            <option value="ماجستير">ماجستير</option>
                            <option value="دكتوراه">دكتوراه</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="major">التخصص الدراسي:</label>
                        <input type="text" name="major" id="major" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="grade">التقدير:</label>
                        <input type="text" name="grade" id="grade">
                    </div>
                    <div class="form-group">
                        <label for="university">الجامعة:</label>
                        <input type="text" name="university" id="university">
                    </div>
                </div>
                <div class="form-group">
                    <label for="graduation_year">سنة التخرج:</label>
                    <input type="text" name="graduation_year" id="graduation_year">
                </div>
            
                <div class="form-group">
                    <label for="languages">اللغات:</label>
                    <div id="language-levels" class="language-levels-container">
                        <!-- مربع اللغة الإنجليزية -->
                        <div id="language-levels" class="language-levels-container">
                            <!-- مربع اللغة الإنجليزية -->
                            <div class="language-box">
                                <h4>الإنجليزية</h4>
                                <label for="reading-english">مستوى القراءة:</label>
                                <select name="reading-english" id="reading-english">
                                    <option value="مبتدئ">مبتدئ</option>
                                    <option value="متوسط">متوسط</option>
                                    <option value="متقدم">متقدم</option>
                                </select>
                                <label for="writing-english">مستوى الكتابة:</label>
                                <select name="writing-english" id="writing-english">
                                    <option value="مبتدئ">مبتدئ</option>
                                    <option value="متوسط">متوسط</option>
                                    <option value="متقدم">متقدم</option>
                                </select>
                                <label for="speaking-english">مستوى المحادثة:</label>
                                <select name="speaking-english" id="speaking-english">
                                    <option value="مبتدئ">مبتدئ</option>
                                    <option value="متوسط">متوسط</option>
                                    <option value="متقدم">متقدم</option>
                                </select>
                            </div>
                            <div class="language-box">
                                <h4>العربية</h4>
                                <label for="reading-arabic">مستوى القراءة:</label>
                                <select name="reading-arabic" id="reading-arabic">
                                    <option value="مبتدئ">مبتدئ</option>
                                    <option value="متوسط">متوسط</option>
                                    <option value="متقدم">متقدم</option>
                                </select>
                                <label for="writing-arabic">مستوى الكتابة:</label>
                                <select name="writing-arabic" id="writing-arabic">
                                    <option value="مبتدئ">مبتدئ</option>
                                    <option value="متوسط">متوسط</option>
                                    <option value="متقدم">متقدم</option>
                                </select>
                                <label for="speaking-arabic">مستوى المحادثة:</label>
                                <select name="speaking-arabic" id="speaking-arabic">
                                    <option value="مبتدئ">مبتدئ</option>
                                    <option value="متوسط">متوسط</option>
                                    <option value="متقدم">متقدم</option>
                                </select>
                            </div>
                        </div>
                       
                    </div>
                </div>
            
                <div class="form-group">
                    <label for="experience">الخبرات:</label>
                    <textarea name="experience" id="experience" rows="4" placeholder="اذكري الوظائف السابقة، أماكن العمل، والفترات الزمنية"></textarea>
                </div>
            
                <div class="form-group">
                    <label for="courses">الدورات:</label>
                    <textarea name="courses" id="courses" rows="3" placeholder="اسم الدورة، مدتها، ومكان الحصول عليها"></textarea>
                </div>
            
                <div class="buttons">
                    <button type="button" id="prev3">السابق</button>
                    <button type="button" id="next3">التالي</button>
                </div>
            </fieldset>
            
            <style>
                .language-levels-container {
        display: flex;
        gap: 20px; 
        margin-top: 10px;
    }
    .language-levels-container > div {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        background-color: #f9f9f9;
        flex: 1; 
    }
    .language-levels-container h4 {
        margin: 0 0 10px 0;
        font-size: 16px;
    }
    .language-levels-container label {
        display: block;
        margin: 5px 0;
    }
    .language-levels-container select {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
    }
    .language-levels-container .language-box {
        display: flex;
        flex-direction: column;
    }
            </style>
            
            {{-- <script>
                function addLanguageFields(select) {
                    const language = select.value;
                    const container = document.getElementById('language-levels');
                    
                    if (language) {
                        const div = document.createElement('div');
                        div.innerHTML = `
                            <h4>${language}</h4>
                            <label for="reading-${language}">مستوى القراءة:</label>
                            <select name="reading-${language}" id="reading-${language}">
                                <option value="مبتدئ">مبتدئ</option>
                                <option value="متوسط">متوسط</option>
                                <option value="متقدم">متقدم</option>
                            </select>
                            <label for="writing-${language}">مستوى الكتابة:</label>
                            <select name="writing-${language}" id="writing-${language}">
                                <option value="مبتدئ">مبتدئ</option>
                                <option value="متوسط">متوسط</option>
                                <option value="متقدم">متقدم</option>
                            </select>
                            <label for="speaking-${language}">مستوى المحادثة:</label>
                            <select name="speaking-${language}" id="speaking-${language}">
                                <option value="مبتدئ">مبتدئ</option>
                                <option value="متوسط">متوسط</option>
                                <option value="متقدم">متقدم</option>
                            </select>
                        `;
                        container.appendChild(div);
                    }
                } --}}
        

            <fieldset>
                <legend>نص الاتفاقية والمرفقات</legend>
                <div class="form-group agreement-group">
                    <input type="checkbox" id="agree" name="agree" required>
                    <label for="agree" class="agreement-label">
                        <span class="checkmark"></span>
                        <span class="agreement-text">أتعهد أنا مقدم الطلب بأن جميع البيانات المقدمة صحيحة وأنا مسؤول عنها.</span>
                    </label>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="job_position">الوظيفة المطلوبة:</label>
                        <input type="text" name="job_position" id="job_position" required>
                    </div>
                    <div class="form-group">
                        <label for="branch">الفرع المطلوب للعمل:</label>
                        <input type="text" name="branch" id="branch" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="min_salary">الحد الأدنى للراتب المطلوب:</label>
                    <input type="text" name="min_salary" id="min_salary" required>
                </div>

                <div class="form-group">
                    <label for="resume">قم بتحميل ملف السيرة الذاتية:</label>
                    <input type="file" name="resume" id="resume" required>
                </div>

                <div class="buttons">
                    <button type="button" id="prev4">السابق</button>
                    <button type="submit">تقديم الطلب</button>
                </div>
            </fieldset>
        
    </div>
</form>
    


    <script>
        const steps = document.querySelectorAll('fieldset');
        const stepIndicators = document.querySelectorAll('.step');
        let currentStep = 0;

        document.getElementById('photo').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('photoPreview').src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('next1').addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            stepIndicators[currentStep].classList.remove('active');
            currentStep++;
            steps[currentStep].classList.add('active');
            stepIndicators[currentStep].classList.add('active');
        });

        document.getElementById('next2').addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            stepIndicators[currentStep].classList.remove('active');
            currentStep++;
            steps[currentStep].classList.add('active');
            stepIndicators[currentStep].classList.add('active');
        });

        document.getElementById('next3').addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            stepIndicators[currentStep].classList.remove('active');
            currentStep++;
            steps[currentStep].classList.add('active');
            stepIndicators[currentStep].classList.add('active');
        });

        document.getElementById('prev2').addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            stepIndicators[currentStep].classList.remove('active');
            currentStep--;
            steps[currentStep].classList.add('active');
            stepIndicators[currentStep].classList.add('active');
        });

        document.getElementById('prev3').addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            stepIndicators[currentStep].classList.remove('active');
            currentStep--;
            steps[currentStep].classList.add('active');
            stepIndicators[currentStep].classList.add('active');
        });

        document.getElementById('prev4').addEventListener('click', () => {
            steps[currentStep].classList.remove('active');
            stepIndicators[currentStep].classList.remove('active');
            currentStep--;
            steps[currentStep].classList.add('active');
            stepIndicators[currentStep].classList.add('active');
        });
        
    function addLanguageFields(select) {
        const language = select.value;
        const container = document.getElementById('language-levels');
        
        container.innerHTML = '';

        // if (language) {
            const div = document.createElement('div');
            div.innerHTML = `
                <h4>${language}</h4>
                <label for="reading-${language}">مستوى القراءة:</label>
                <select name="reading-${language}" id="reading-${language}">
                    <option value="مبتدئ">مبتدئ</option>
                    <option value="متوسط">متوسط</option>
                    <option value="متقدم">متقدم</option>
                </select>
                <label for="writing-${language}">مستوى الكتابة:</label>
                <select name="writing-${language}" id="writing-${language}">
                    <option value="مبتدئ">مبتدئ</option>
                    <option value="متوسط">متوسط</option>
                    <option value="متقدم">متقدم</option>
                </select>
                <label for="speaking-${language}">مستوى المحادثة:</label>
                <select name="speaking-${language}" id="speaking-${language}">
                    <option value="مبتدئ">مبتدئ</option>
                    <option value="متوسط">متوسط</option>
                    <option value="متقدم">متقدم</option>
                </select>
            `;
            container.appendChild(div);
        }
    
    </script>
</body>
</html>

