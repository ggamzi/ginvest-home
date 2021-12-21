// $(function () {
//     $(".visual_roll").slick({
//         dots: true,
//         fade: true,
//         draggable: false,
//         pauseOnHover: true,
//         autoplay: true,
//         autoplaySpeed: 4000,
//     });
//     $(".visual_roll .slick-dots li button").eq(0).html("브랜드 대상 1위");
//     $(".visual_roll .slick-dots li button").eq(1).html("올바른 투자의 가치!");
//     $(".visual_roll .slick-dots li button").eq(2).html("증권가 시그널 포착!");
// });

// 메인화면 우측 VIP 무료체험 신청란
function myreg_form_main_vip_chk() {
    var form = document.myreg_form_main_vip;
    
    // Validation Start
    if (document.getElementById('s_v5_0')) {
        if (form.s_v5_0.checked == false) {
            alert("개인정보 취급 방침에 동의 하셔야 합니다.");
            form.s_v5_0.focus();
            return;
        }
    }
    if (document.getElementById('s_v6_0')) {
        if (form.s_v6_0.checked == false) {
            alert("마케팅 수신 동의 하셔야 합니다.");
            form.s_v6_0.focus();
            return;
        }
    }
    if (document.getElementById('s_v7_0')) {
        if (form.s_v7_0.checked == false) {
            alert("제3자 정보제공동의 하셔야 합니다.");
            form.s_v7_0.focus();
            return;
        }
    }
    if (!form.s_v2_hp1.value) {
        alert('휴대폰 번호를 입력해주세요.');
        form.s_v2_hp1.focus();
        return;
    }
    if (!form.s_v2_hp2.value) {
        alert('휴대폰 번호를 입력해주세요.');
        form.s_v2_hp2.focus();
        return;
    }
    if (!form.s_v2_hp3.value) {
        alert('휴대폰 번호를 입력해주세요.');
        form.s_v2_hp3.focus();
        return;
    }

    var reg_name = /^[가-힣]{2,4}$/;
    var regexp = /^[0-9]*$/;

    if (!reg_name.test(form.s_v1.value)) {
        alert("이름을 확인해주세요(한글2 ~ 4자 이내)");
        form.s_v1.focus();
        return false;
    }

    if (!regexp.test(form.s_v2_hp1.value)) {
        alert("숫자만 입력하세요");
        form.s_v2_hp1.focus();
        return false;
    }
    if (!regexp.test(form.s_v2_hp2.value)) {
        alert("숫자만 입력하세요");
        form.s_v2_hp2.focus();
        return false;
    }
    if (!regexp.test(form.s_v2_hp3.value)) {
        alert("숫자만 입력하세요");
        form.s_v2_hp3.focus();
        return false;
    }
    // Validation END

    //ajax
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: "/exper/create",
        type: "post",
        data: {
            'name': form.s_v1.value
        },
        dataType: 'json',
        success:function(data){   
            switch (data.status) {
                case "success":
                    alert('삭제되었습니다.');
                    location.reload();
                    break;
                case "error":
                    alert(data.msg);
                    break;
            }   
        },
        error:function(jqXHR, textStatus, errorThrown){
            alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
            console.log(data);
            self.close();
        }
    });


    // form.method = 'post';

    // var default_action = '/shop_contents/myreg_exec.php';
    // form.action = default_action;
    // form.target = create_iframe();

    // if (ssl_possible == 'on' && document.getElementsByName('post_action').length && document.getElementsByName('this_domain').length) {
    //     form.post_action.value = default_action;
    //     form.action = 'https://' + ssl_host + '/ssl/post_all_reg.php';
    //     form.this_domain.value = 'www.ginvest.co.kr';
    // }

 
    // formpage api
    // let formData = new FormData
    // formData.append("name", form.s_v1.value)
    // formData.append("phone", form.s_v2_hp1.value + form.s_v2_hp2.value + form.s_v2_hp3.value)
    // formData.append("utm_source", $.urlParam('utm_source'))
    // formData.append("utm_medium", $.urlParam('utm_medium'))

    // fetch("https://formpage.co.kr/api/inflow", {
    //     method: "post",
    //     body: formData,
    // })
    //     .then(res => res.text())
    //     .then(data => {
    //         console.log(data)
    //     })

    // _trk_flashEnvView("_TRK_CP=카테고리명","_TRK_PI=RGR","_TRK_SX=성별","_TRK_AG=특성");

    form.submit();
}

function myreg_form_main_vip2_chk2(){
    var regex1 =  /^[ㄱ-ㅎ가-힣A-Za-z0-9]+$/; //한글, 영문, 숫자
    var regex2 =  /^[0-9]+$/; // 숫자

    var s_v1_val = $('[name=s_v1]').val();
            var s_v2_hp1_val = $('[name=s_v2_hp1]').val();
            var s_v2_hp2_val = $('[name=s_v2_hp2]').val();
            var s_v2_hp3_val = $('[name=s_v2_hp3]').val();

            if (s_v1_val.length > 0 && !regex1.test(s_v1_val)) {
                alert('이름은 한글, 영문, 숫자만 입력할 수 있습니다.');
                $('[name=s_v1]').val('');
                $('[name=s_v1]').focus();
                return false;
            }
            if (s_v2_hp1_val.length > 0 && !regex2.test(s_v2_hp1_val)) {
                alert('전화번호는 숫자만 입력할 수 있습니다.');
                $('[name=s_v2_hp1]').val('');
                $('[name=s_v2_hp1]').focus();
                return false;
            }
            if (s_v2_hp2_val.length > 0 && !regex2.test(s_v2_hp2_val)) {
                alert('전화번호는 숫자만 입력할 수 있습니다.');
                $('[name=s_v2_hp2]').val('');
                $('[name=s_v2_hp2]').focus();
                return false;
            }
            if (s_v2_hp3_val.length > 0 && !regex2.test(s_v2_hp3_val)) {
                alert('전화번호는 숫자만 입력할 수 있습니다.');
                $('[name=s_v2_hp3]').val('');
                $('[name=s_v2_hp3]').focus();
                return false;
            }

            if (document.getElementById('s_v5_0')) {
                if ($("input:checkbox[name=s_v5_0]").is(":checked") == false) {
                    alert("개인정보 취급 방침에 동의 하셔야 합니다.");
                    $('[name=s_v5_0]').focus();
                    return;
                }
            }
            if (document.getElementById('s_v6_0')) {
                if ($("input:checkbox[name=s_v6_0]").is(":checked") == false) {
                    alert("마케팅 수신 동의 하셔야 합니다.");
                    $('[name=s_v6_0]').focus();
                    return;
                }
            }
            if (document.getElementById('s_v7_0')) {
                if ($("input:checkbox[name=s_v7_0]").is(":checked") == false) {
                    alert("제3자 정보제공동의 하셔야 합니다.");
                    $('[name=s_v7_0]').focus();
                    return;
                }
            }
    let form = document.myreg_form_main_vip2
    let formData = new FormData
                formData.append("name", form.s_v1.value)
                formData.append("phone",form.s_v2_hp1.value + form.s_v2_hp2.value + form.s_v2_hp3.value)
                        formData.append("utm_source", $.urlParam('utm_source'))
                        formData.append("utm_medium", $.urlParam('utm_medium'))
    fetch("https://formpage.co.kr/api/inflow", {
        method: "post",
        body: formData,
    })
    .then(res => res.text())
    .then(data => {
        console.log(data)
    })
    _trk_flashEnvView("_TRK_CP=카테고리명","_TRK_PI=RGR","_TRK_SX=성별","_TRK_AG=특성");
    myreg_form_main_vip2_chk();
}

var zip_var = '';
function zipcode_search_new(sel_var){
    zip_var = sel_var;
    var window_left = (screen.width-640)/2;
    var window_top = (screen.height-480)/2;

    if(typeof search_zip === 'function'){
        search_zip();
    }else{
        var postcodefind = window.open('/shop_popup/zipcode.htm','postcodefind','resizable=yes,toolbar=no,width=500,height=410,scrollbars=yes,top=' + window_top + ',left=' + window_left + '');
        postcodefind.focus();
    }
}


var zipcode_sel_num = '';
var addr1_sel_num = '';
function zipcode_search(num1,num2){
    zipcode_sel_num = num1;
    addr1_sel_num = num2;
    zip_var = '';

    var window_left = (screen.width-640)/2;
    var window_top = (screen.height-480)/2;
    var postcodefind = window.open('/shop_popup/zipcode.htm','postcodefind','resizable=yes,toolbar=no,width=500,height=410,scrollbars=yes,top=' + window_top + ',left=' + window_left + '');
    postcodefind.focus();
}

function put_postno( No1, No2, add1, add2,note){
    if(zip_var != ''){
        var obj1 = document.getElementsByName(zip_var+'_1')[0];
        var obj2 = document.getElementsByName(zip_var+'_2')[0];
    }else{
        var obj1 = document.getElementsByName('s_v'+zipcode_sel_num)[0];
        var obj2 = document.getElementsByName('s_v'+addr1_sel_num)[0];
    }
    obj1.value =  No1+'-'+No2;
    obj2.value =  add1+' '+add2;
}

function new_put_postno(zipcode, addr){
    if(zip_var != ''){
        var obj1 = document.getElementsByName(zip_var+'_1')[0];
        var obj2 = document.getElementsByName(zip_var+'_2')[0];
    }else{
        var obj1 = document.getElementsByName('s_v'+zipcode_sel_num)[0];
        var obj2 = document.getElementsByName('s_v'+addr1_sel_num)[0];
    }
    obj1.value =  zipcode;
    obj2.value =  addr;
}


function myreg_form_main_vip2_chk(){
    var form = document.myreg_form_main_vip2;
        
    if(document.getElementById('myreg_privacy_chk')){
    if(form.myreg_privacy_chk.checked == false){
    alert("개인정보 취급 방침에 동의 하셔야 합니다.");
    form.myreg_privacy_chk.focus();
    return;
    }
    }


    if(!form.s_v2_hp1.value) {
    alert('휴대폰 번호를 입력해주세요.');
    form.s_v2_hp1.focus();
    return ;
    }
    if(!form.s_v2_hp2.value) {
    alert('휴대폰 번호를 입력해주세요.');
    form.s_v2_hp2.focus();
    return ;
    }
    if(!form.s_v2_hp3.value) {
    alert('휴대폰 번호를 입력해주세요.');
    form.s_v2_hp3.focus();
    return ;
    }
    if(  !form.s_v5_0.checked  ){
        alert("개인정보취급방침동의을(를) 선택해주세요.");
        form.s_v5_0.focus();
        return;
    }
    if(  !form.s_v6_0.checked  ){
        alert("마케팅 수신동의을(를) 선택해주세요.");
        form.s_v6_0.focus();
        return;
    }
    if(  !form.s_v7_0.checked  ){
        alert("제3자 정보제공동의을(를) 선택해주세요.");
        form.s_v7_0.focus();
        return;
    }

    form.method='post';

    var default_action = '/shop_contents/myreg_exec.php';
    form.action = default_action;
    form.target=create_iframe();

    if(ssl_possible == 'on' && document.getElementsByName('post_action').length && document.getElementsByName('this_domain').length){
    form.post_action.value = default_action;
    form.action = 'https://'+ssl_host+'/ssl/post_all_reg.php';
    form.this_domain.value = 'www.ginvest.co.kr';
    }

    // 용량이 큰 파일을 첨부하는경우 고객이 여러번 클릭 할수 있으므로 아래와 같이 처리해서 2번 클릭하지 못하게 막는다.

    if(document.getElementById('div_submit_bt')){
    document.getElementById('div_submit_bt').style.display = 'none';
    }
    if(document.getElementById('div_wait_bt')){
    document.getElementById('div_wait_bt').style.display = 'block';
    }

    form.submit();
}