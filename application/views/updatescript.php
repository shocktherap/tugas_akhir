                <script type="text/javascript">
                function startTotal () {
                  interval1 = setInterval("startCalc1()",1);
                }
                function stopTotal(){
                  clearInterval(interval);                  
                }
                </script>
                <script type="text/javascript">
                function startTotalBB () {
                    interval3 = setInterval("startCalc8()",3);
                }
                function stopTotalBB(){
                  clearInterval(interval);                  
                }
                </script>
                <script type="text/javascript">
                function startTotalBPR () {
                  interval1 = setInterval("startCalcBPR()",1);
                  interval3 = setInterval("startCalc6()",3);
                }
                function stopTotalBPR(){
                  clearInterval(interval);                  
                }
                </script>

                <script type="text/javascript">
                function startTotalATK () {
                  interval3 = setInterval("startCalcatk1()",3);
                }
                function stopTotalATK(){
                  clearInterval(interval);                  
                }
                </script>

                <script type="text/javascript">
                function startTotalBHP() {
                  interval1 = setInterval("startCalcbhp1()",1);
                }
                function stopTotalBHP(){
                  clearInterval(interval);                  
                }
                </script>

                <script type="text/javascript">
                function startTotalLDJ() {
                  interval1 = setInterval("startCalcldj1()",1);
                }
                function stopTotalLDJ(){
                  clearInterval(interval);                  
                }
                </script>

                <script type="text/javascript">
                function startTotalPP() {
                  interval1 = setInterval("startCalcpp1()",1);
                }
                function stopTotalPP(){
                  clearInterval(interval);                  
                }
                </script>
                <!-- untuk menghitung update total calc 1 sampai 4 -->
                <script type="text/javascript">
                  function startCalc1(){
                    interval = setInterval("calc1()",1);
                  }
                  function calc1(){
                    one = document.entry.total.value;
                    two = document.entry.hitung1.value; 
                    three = document.entry.hitung2.value; 
                    four = document.entry.hitung3.value; 
                    five = document.entry.hitung4.value; 
                    document.entry.hasil1.value = (two / 100)*one;
                    document.entry.hasil2.value = (three / 100)*one;
                    document.entry.hasil3.value = (four / 100)*one;
                    document.entry.hasil4.value = (five / 100)*one;
                    document.entry.totalbb.value = (three / 100)*one;
                    document.entry.totalbpr.value = (four / 100)*one;
                    document.entry.hitungpersentasetotal.value = (two * 1)+(three * 1)+(four * 1)+(five*1);
                    document.entry.hitungjumlahtotal.value = (((two/100)+(three/100)+(four/100)+(five/100))*one);
                  }
                  function stopCalc1(){
                    clearInterval(interval);
                  }
                </script>
                <!-- untuk menghitung update bpr calc 6 dan 7 -->
                <script type="text/javascript">
                  function startCalc6(){
                    interval = setInterval("calc6()",1);
                  }
                  function calc6(){
                    one = document.entry.totalbpr.value;
                    two = document.entry.hitungtotalbpr6.value; 
                    three = document.entry.hitungtotalbpr7.value;
                    document.entry.hasilhitungtotalbpr6.value = (two / 100)*one;
                    document.entry.hasilhitungtotalbpr7.value = (three / 100)*one;
                  }
                  function stopCalc6(){
                    clearInterval(interval);
                  }
                </script>
                <!-- untuk menghitung update bb atk -->
                <script type="text/javascript">
                  function startCalc8(){
                    interval = setInterval("calc8()",1);
                  }
                  function calc8(){
                    one = document.entry.totalbb.value;
                    two = document.entry.hitungtotalbb8.value;
                    three = document.entry.hitungtotalbb9.value;
                    four = document.entry.hitungtotalbb10.value;
                    five = document.entry.hitungtotalbb11.value;
                    six = document.entry.hitungtotalbb12.value;
                    seven = document.entry.hitungtotalbb13.value;
                    eight = document.entry.hitungtotalbb14.value;
                    document.entry.hasilhitungtotalbb8.value = (two / 100)*one;
                    document.entry.hasilhitungtotalbb9.value = (three / 100)*one;
                    document.entry.hasilhitungtotalbb10.value = (four / 100)*one;
                    document.entry.hasilhitungtotalbb11.value = (five / 100)*one;
                    document.entry.hasilhitungtotalbb12.value = (six / 100)*one;
                    document.entry.hasilhitungtotalbb13.value = (seven / 100)*one;
                    document.entry.hasilhitungtotalbb14.value = (eight / 100)*one;
                    document.entry.totalatk.value = (two / 100)*one;
                    document.entry.totalbhp.value = (three / 100)*one;
                    document.entry.totalldj.value = (four / 100)*one;
                    document.entry.totalkbm.value = (five / 100)*one;
                    document.entry.totalks.value = (six / 100)*one;
                    document.entry.totalpp.value = (seven / 100)*one;
                    document.entry.hitungpersentasebb.value = (two * 1)+(three * 1)+(four * 1)+(five * 1)+(six * 1)+(seven * 1 )+(eight*1);
                    document.entry.hitungjumlahbb.value = (((two/100)+(three/100)+(four/100)+(five/100)+(six/100)+(seven/100)+(eight/100)+(seven/100)+(eight*1))*one);
                  }
                  function stopCalc8(){
                    clearInterval(interval);
                  }
                </script>

                <!-- +fungsi hitung total persentase subkriteria Belanja Pemeliharaan================================================+ -->                
                <script type="text/javascript">
                  function startCalcBPR(){
                    interval = setInterval("calcBPR()",1);
                  }
                  function calcBPR(){
                    one = document.entry.hitungtotalbpr6.value;
                    two = document.entry.hitungtotalbpr7.value;
                    document.entry.hitungpersentasebpr.value = (one * 1)+(two * 1);

                    three = document.entry.hasilhitungtotalbpr6.value;
                    four = document.entry.hasilhitungtotalbpr7.value;
                    document.entry.hitungjumlahbpr.value = (three * 1)+(four * 1);
                  }
                  function stopCalcBPR(){
                    clearInterval(interval);
                  }
                </script>
                <!-- end -->

                <!-- +fungsi hitung total persentase subkriteria atk================================================+ -->
                <script type="text/javascript">
                  function startCalcatk1(){
                    interval = setInterval("calcatk1()",1);
                  }
                  function calcatk1(){
                    one = document.entry.totalatk.value;
                    two = document.entry.hitungtotalatk1.value; 
                    three = document.entry.hitungtotalatk2.value; 
                    four = document.entry.hitungtotalatk3.value; 
                    five = document.entry.hitungtotalatk4.value; 
                    document.entry.hasilhitungtotalatk1.value = (two / 100)*one;
                    document.entry.hasilhitungtotalatk2.value = (three / 100)*one;
                    document.entry.hasilhitungtotalatk3.value = (four / 100)*one;
                    document.entry.hasilhitungtotalatk4.value = (five / 100)*one;
                    document.entry.hitungpersentaseatk.value = (two*1)+(three*1)+(four*1)+(five*1);
                    document.entry.hitungjumlahatk.value = (((two/100)+(three/100)+(four/100)+(five/100))*one);
                  }
                  function stopCalcatk1(){
                    clearInterval(interval);
                  }
                </script>

                <!-- end -->

                <!-- +fungsi hitung total persentase subkriteria bhp================================================+ -->
                <script type="text/javascript">
                  function startCalcbhp1(){
                    interval = setInterval("calcbhp1()",1);
                  }
                  function calcbhp1(){
                    one = document.entry.totalbhp.value;
                    two = document.entry.hitungtotalbhp1.value; 
                    three = document.entry.hitungtotalbhp2.value; 
                    document.entry.hasilhitungtotalbhp1.value = (two / 100)*one;
                    document.entry.hasilhitungtotalbhp2.value = (three / 100)*one;
                    document.entry.hitungpersentasebhp.value = (two*1)+(three*1);
                    document.entry.hitungjumlahbhp.value = ((two / 100)*one)+((three / 100)*one);
                  }
                  function stopCalcbhp1(){
                    clearInterval(interval);
                  }
                </script>
                <!-- end -->

                <!-- +fungsi hitung total persentase subkriteria ldj================================================+ -->
                <script type="text/javascript">
                  function startCalcldj1(){
                    interval = setInterval("calcldj1()",1);
                  }
                  function calcldj1(){
                    one = document.entry.totalldj.value;
                    two = document.entry.hitungtotalldj1.value; 
                    three = document.entry.hitungtotalldj2.value; 
                    document.entry.hasilhitungtotalldj1.value = (two / 100)*one;
                    document.entry.hasilhitungtotalldj2.value = (three / 100)*one;

                    document.entry.hitungpersentaseldj.value = (two*1)+(three*1);
                    document.entry.hitungjumlahldj.value = ((two / 100)*one)+((three / 100)*one);

                  }
                  function stopCalcldj1(){
                    clearInterval(interval);
                  }
                </script>
                <!-- end -->

                <!-- +fungsi hitung total persentase subkriteria pp================================================+ -->
                <script type="text/javascript">
                  function startCalcpp1(){
                    interval = setInterval("calcpp1()",1);
                  }
                  function calcpp1(){
                    one = document.entry.totalpp.value;
                    two = document.entry.hitungtotalpp1.value; 
                    three = document.entry.hitungtotalpp2.value; 
                    document.entry.hasilhitungtotalpp1.value = (two / 100)*one;
                    document.entry.hasilhitungtotalpp2.value = (three / 100)*one;

                    document.entry.hitungpersentasepp.value = (two*1)+(three*1);
                    document.entry.hitungjumlahpp.value = ((two / 100)*one)+((three / 100)*one);

                  }
                  function stopCalcpp1(){
                    clearInterval(interval);
                  }
                </script>

                <!-- end -->

                <!-- +fungsi hitung total persentase subkriteria ks================================================+ -->
                <script type="text/javascript">
                  function startCalcks1(){
                    interval = setInterval("calcks1()",1);
                  }
                  function calcks1(){
                    one = document.entry.totalks.value;
                    two = document.entry.hitungtotalks1.value; 
                    three = document.entry.hitungtotalks2.value; 
                    four = document.entry.hitungtotalks3.value; 
                    five = document.entry.hitungtotalks4.value; 
                    six = document.entry.hitungtotalks5.value; 
                    document.entry.hasilhitungtotalks1.value = (two / 100)*one;
                    document.entry.hasilhitungtotalks2.value = (three / 100)*one;
                    document.entry.hasilhitungtotalks3.value = (four / 100)*one;
                    document.entry.hasilhitungtotalks4.value = (five / 100)*one;
                    document.entry.hasilhitungtotalks5.value = (six / 100)*one;
                    document.entry.hitungpersentaseks.value = (two*1)+(three*1)+(four*1)+(five*1)+(six*1);
                    document.entry.hitungjumlahks.value = (((two/100)+(three/100)+(four/100)+(five/100)+(six/100))*one);
                  }
                  function stopCalcks1(){
                    clearInterval(interval);
                  }
                </script>
                <!-- end -->

                <!-- +fungsi hitung total persentase subkriteria kbm================================================+ -->
                <script type="text/javascript">
                  function startCalckbm1(){
                    interval = setInterval("calckbm1()",1);
                  }
                  function calckbm1(){
                    one = document.entry.totalkbm.value;
                    two = document.entry.hitungtotalkbm1.value; 
                    three = document.entry.hitungtotalkbm2.value; 
                    four = document.entry.hitungtotalkbm3.value; 
                    five = document.entry.hitungtotalkbm4.value; 
                    six = document.entry.hitungtotalkbm5.value; 
                    seven = document.entry.hitungtotalkbm6.value; 
                    eight = document.entry.hitungtotalkbm7.value; 
                    nine = document.entry.hitungtotalkbm8.value; 
                    document.entry.hasilhitungtotalkbm1.value = (two / 100)*one;
                    document.entry.hasilhitungtotalkbm2.value = (three / 100)*one;
                    document.entry.hasilhitungtotalkbm3.value = (four / 100)*one;
                    document.entry.hasilhitungtotalkbm4.value = (five / 100)*one;
                    document.entry.hasilhitungtotalkbm5.value = (six / 100)*one;
                    document.entry.hasilhitungtotalkbm6.value = (seven / 100)*one;
                    document.entry.hasilhitungtotalkbm7.value = (eight / 100)*one;
                    document.entry.hasilhitungtotalkbm8.value = (nine / 100)*one;

                    document.entry.hitungpersentasekbm.value = (two*1)+(three*1)+(four*1)+(five*1)+(six*1)+(seven*1)+(eight*1)+(seven*1);
                    document.entry.hitungjumlahkbm.value = (((two/100)+(three/100)+(four/100)+(five/100)+(six/100)+(seven/100)+(eight/100)+(seven/100))*one);
                    
                  }
                  function stopCalckbm1(){
                    clearInterval(interval);
                  }
                </script>