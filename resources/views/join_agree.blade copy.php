@extends('layout.masterLayout')

@section('style')

    <!-- 약관동의 -->
    <link rel="stylesheet" type="text/css" href="/src_css/farm_design_a_mobile.css" />
    <link rel="stylesheet" type="text/css" href="/src_css/farm_design_a_tablet.css" media="only all and (min-width:768px)"/>
    <link rel="stylesheet" type="text/css" href="/src_css/farm_design_a_pc.css" media="only all and (min-width:1024px)"/>
@endsection

@section('body')

<div class="cont">
      
<div class="farm-A-agree-wrap sb">
	<div class="farm-A-agree">
    <form id="join_agree" action="/join" method="get">
        @csrf
		<h4 class="farm-A-title">이용약관</h4>
		<div class="farm-A-agree-box terms_use">
            <!-- <style>
            .terms_use strong{ font-size: 16px; font-weight: 600; color: #222;}
            </style>
			<strong>갤럭시투자그룹 이용약관</strong> -->
            @php $get_info = getInfo() @endphp
            @php echo $get_info['terms_use']['content'] @endphp
            
<!-- <p class="mg20t">제1조(목적)</p> 
<p>이 약관은 (주)머니랩솔루션즈(이하 “회사”또는 “ 갤럭시투자그룹”이라고 합니다)으로부터 유가증권 투자 등에 대한 정보를 제공받고자 하는 자(이하 “이용자”라고 합니다)에게 회사가 종목 추천 등의 서비스(이하 “서비스”라고 합니다)를 제공함에 있어 회사와 이용자 간의 권리, 의무 및 책임사항을 규정하는 것을 그 목적으로 합니다. </p>
<p class="mg20t">제2조(용어의 정의) </p>
<p>이 약관에서 사용하는 용어의 정의는 다음과 같습니다. </p>
<p>① “이용계약”이라 함은 서비스 이용을 위해 회사와 이용자 사이에 체결하는 계약을 말합니다. </p>
<p>② “이용요금”이라 함은 이용계약에 따라 이용자가 회사에게 지급하여야 할 금원을 말합니다. </p>
<p>③ “승계인”이라 함은 이용계약에서 정한 바에 따라 이용자의 권리, 의무를 승계한 자를 말합니다. </p>
<p>④ “사이트”라 함은 회사가 운영하는 홈페이지(www.ginvest.co.kr)를 말합니다. </p>
<p>⑤ “무료 서비스 기간”이라 함은 회사가 이벤트 등의 사유로 이용자에게 무료로 서비스를 제공하기로 약정한 기간을 말합니다. </p>
<p>⑥ “제휴회사”라 함은 회사가 이용자에게 이용계약에 따른 서비스를 제공함에 있어서 회사와 업무 제휴를 한 회사를 말합니다.</p>
 
<p class="mg20t">제3조(유료 서비스) </p>
<p>이 약관에 따라 회사가 이용자에게 제공하는 서비스는 이용요금이 부과되는 유료 서비스입니다. </p>
 
<p class="mg20t">제4조(약관의 게시 및 변경) </p>
<p>① 이 약관은 회사가 이용자가 이 약관의 내용을 알 수 있도록 사이트에 공지함으로써 효력이 발생합니다. </p>
<p>② 회사는 필요한 경우 약관의 규제에 관한 법률, 정보통신망이용촉진 등에 관한 법률, 전자거래기본법, 전자서명법 등 관련 법령에 위배되지 않는 범위 내에서 이 약관을 변경할 수 있고, 회사가 이 약관을 변경할 경우에는 변경된 약관의 효력 발생 일자 및 변경 사유를 사이트의 공지사항 게시판에 공지합니다. </p>
<p>③ 회사는 약관이 변경된 경우 이용자에게 약관 변경 사실 및 내용을 통지하고, 이용자가 변경된 약관 적용일까지 약관 변경에 대한 거절의 의사표시를 명시적으로 하지 아니할 경우 변경된 약관에 동의한 것으로 간주하며, 변경된 약관에 대한 정보를 알지 못하여 발생하는 이용자의 피해에 대하여 회사는 일체의 책임을 지지 않습니다. </p>
<p>④ 이용자가 변경된 약관에 대한 거절의 의사표시를 한 경우 제26조에서 정한 바에 따라 이용계약은 해지되고, 회사는 환불 절차를 진행합니다. </p>
 
<p class="mg20t">제5조(약관의 해석) </p>
<p>이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 회사의 기본이용약관 또는 개별약관에 정함이 있는 경우에는 그에 따르고, 회사의 기본이용약관 또는 개별약관에 정함이 없는 경우에는 약관의 규제에 관한 법률 등 관련 법령이나 상관례에 따릅니다. </p>
 
<p class="mg20t">제6조(이용자에 대한 통지) </p>
<p>① 회사가 이용자에 대한 통지를 하는 경우, 회사는 이용자에게 SMS, E-mail, 팩스, 휴대전화, 일반전화, 우편 등의 방법으로 할 수 있습니다. </p>
<p>② 이용자 전체에 대한 통지의 경우에는 회사는 7일 이상 사이트에 이를 게시함으로써 제1항의 개별통지에 갈음할 수 있습니다. </p>
 
<p class="mg20t">제7조(개인정보의 보호) </p>
<p>① 회사는 이용자의 정보를 수집함에 있어 서비스 제공에 필요한 최소한의 정보만을 수집합니다. </p>
<p>② 회사는 이용자의 동의 없이 이용자가 제공한 개인정보를 이 약관에서 정한 목적 외의 다른 목적으로 사용하거나 제3자에게 제공할 수 없습니다. </p>
<p>③ 회사는 관련 법령이 정하는 바에 따라서 이용자의 개인정보를 보호하기 위한 정책을 수립하고 개인정보보호책임자를 지정하여 이를 게시합니다. </p>
<p>④ 이용자의 개인정보보호에 관해서는 관련 법령 및 회사가 정하는 개인정보취급방침에서 정한 바에 따릅니다. </p>
 
<p class="mg20t">제8조(이용신청) </p>
<p>① 서비스 이용을 원하는 이용자는 회사가 정한 양식의 이용신청서를 작성하여 제출하거나 사이트에 있는 가입 양식에 따라 이용자 정보를 기입한 후 이 약관에 동의한다는 의사표시를 하는 방법으로 서비스 이용을 신청합니다. 다만, 이용자의 이용신청과 관련하여 회사가 필요한 서류를 요구하는 경우에는 이용자는 해당 서류를 제출하여야 합니다. </p>
<p>② 서비스 이용신청은 반드시 이용자의 실명으로 하여야 하고, 이용자는 이용신청시 투자금을 명시하여야 합니다. </p>
 
<p class="mg20t">제9조(이용자의 확인사항) </p>
<p>이용자는 회사가 제공하는 서비스를 이용하여 이용자가 유가증권 투자 기타 거래를 함에 있어 최종적인 판단 및 결정에 대한 책임이 이용자에게 있음을 확인하고, 이 약관에서 별도로 정한 경우를 제외하고 이용자에게 발생한 손실 또는 손해에 대해 회사에 책임을 묻지 않을 것을 확인합니다. </p>
 
<p class="mg20t">제10조(이용계약의 체결) </p>
<p>제8조의 규정에 따라 적법하게 이루어진 이용신청에 대해 회사가 승낙한 경우 이용계약이 체결된 것으로 봅니다. </p>
 
<p class="mg20t">제11조(이용신청에 대한 승낙 거부) </p>
<p>① 회사는 다음 각 호중 어느 하나에 해당되는 사유가 있는 경우 이용신청을 승낙하지 않을 수 있습니다. </p>
<p>1. 주민등록표상의 성명과 다른 성명으로 이용신청을 한 경우. </p>
<p>2. 두 개의 아이디를 사용하여 이용신청을 한 경우. </p>
<p>3. 주민등록표상 만 14세 이하의 자가 이용신청을 한 경우. </p>
<p>4. 이용신청에 필요한 개인 정보를 허위로 기재하였거나 허위 서류를 첨부하여 이용신청을 한 경우. </p>
<p>5. 회사가 제공하는 정보를 상업적 목적에 이용하거나 다른 이용자의 이익을 해할 목적으로 이용신청을 한 경우. </p>
<p>6. 이전에 이용계약을 해지당하거나 해지한 적이 있는 경우. </p>
<p>7. 회사의 설비 용량 및 기술상의 문제 등으로 인해 서비스 제공이 어렵다고 회사가 판단하는 경우. </p>
<p>② 회사는 제1항에 따라 이용신청에 대한 승낙을 거부하는 경우 이를 이용신청자에게 알려야 합니다. </p>
 
<p>제12조(서비스 제공 시기) </p>
<p>① 이용자가 회사에서 정한 서비스 이용요금을 납부하고 회사의 가입신청양식에 의해 유료회원가입을 신청한 회원에 한해 회사는 이용계약이 승낙한 때[서비스 시작 예정일-오전 8시]를 서비스 제공 개시일로 합니다. 다만, 회사의 업무상 또는 기술상의 지장으로 인해 서비스를 즉시 개시하지 못할 경우에는 회원에게 이를 지체 없이 통보한 후 서비스의 제공을 유보할 수 있습니다. </p>
<p>② 유료회원의 서비스는 일, 월 단위로 제공되며, 일, 월 단위가 끝나는 시점에서 재이용 의사를 밝히지 않을 경우 서비스 제공은 자동으로 중지 됩니다. </p>
 
<p class="mg20t">제13조(서비스 상품의 종류 및 이용요금, 약정기간) </p>
<p>① 이 약관에 따라 회사가 이용자에게 제공하는 서비스 상품의 종류 및 이용요금, 약정기간은 다음 각 호와 같습니다. </p>
<p>1. VVVIP 서비스 – 1년 금 사천팔백만원(₩48,000,000원, 부가세 포함),1개월 금 사백만원(₩4,000,000원, 부가세 포함),</p>
<p>2. VVIP 서비스 – 1년 금 삼천육백만원(₩36,000,000원, 부가세 포함), 6개월 금 천팔백만원(₩18,000,000원, 부가세 포함), 3개월 금 구백만원(₩9,000,000원, 부가세 포함), 1개월 금 삼백만원(₩3,000,000원, 부가세 포함),</p>
<p>3. VIP 서비스 - 이용요금 1년 금 이천사백만원 (₩24,000,000, 부가세 포함), 6개월 금 천이백만원 (₩12,000,000, 부가세 포함), 3개월 금 육백만원(₩6,000,000, 부가세포함), 1개월 금 이백만원(₩2,000,000원, 부가세 포함), </p>
<p>제13조의 1(실전매매기법 교육동영상 또는 주식교육도서의 매매)</p>
<p>① 이용자는 제13조 제1항 제1호부터 제4호까지의 서비스와 별도로 회사가 제공하는 각 서비스 상품별 실전매매기법 교육동영상(이하 “동영상”이라고 합니다)을 각 개당 금 오십오만원(₩550,000원, 부가세 포함), 주식 교육 도서(이하 “도서”라고 합니다) 각 개당 금 일만일천원(\11,000원,부가세포함)에 별도로 매수할 수 있습니다. </p>
<p>② 동영상 또는 도서에 대한 매매계약의 체결 및 내용 등은 회사가 작성한 별도의 동영상 또는 도서 매매 약관(이하 “동영상 등 약관”이라고 합니다)에서 정한 바에 따릅니다.</p>
 
<p class="mg20t">제14조(유료 서비스의 내용) </p>
<p>① VVVIP 서비스 </p>
<p>1. VVVIP 추천종목 및 부가정보 SMS 발송.</p>
<p>2. 부가서비스 제공, 다만 이 서비스는 제휴회사의 상황에 따라 일부 변경될 수 있습니다. </p>
<p>3. 동영상 및 도서 제공, 다만 이 서비스는 동영상 등 약관에 동의한 이용자들에 한하여 제공합니다. </p>
<p>② VVIP 서비스 </p>
<p>1. VVIP 종합반 추천종목 및 부가정보 SMS 발송. </p>
<p>2. 동영상 및 도서 제공, 다만 이 서비스는 동영상 등 약관에 동의한 이용자들에 한하여 제공합니다. </p>
<p>③ VIP 서비스</p>
<p>1. VIP문자반 서비스 추천종목 및 부가정보 SMS 발송. </p>
<p>2. 투자리포트 제공. </p>
<p>3 동영상 및 도서 제공, 다만 이 서비스는 동영상 등 약관에 동의한 이용자들에 한하여 제공합니다. </p>

  
<p class="mg20t">제14조의 1(무료 서비스의 내용)</p>
<p>① 회사는 이벤트 및 기타 사유로 이용자에게 무료 서비스를 제공할 수 있습니다. </p>
<p>② 무료 서비스의 내용은 각 상품별 유료 서비스의 내용과 동일합니다. </p>
<p>③ 회사가 이용자에게 제1항에 따라 제공하는 무료 서비스 기간은 이용계약의 계약기간에 포함되지 않습니다. </p>
<p>④ 이용자는 이용계약상의 계약기간(“유료 서비스” 계약기간을 의미합니다)이 만료되어 이용계약이 종료된 경우에 한하여 회사가 제공한 무료 서비스를 이용할 수 있습니다. 다만, 무료서비스 이용기간 중 회사 홈페이지 또는 모바일(전용 메신저)에 6개월 이상 로그인을 하지 않는 이용자는 “미이용 회원(휴면계정)”으로 전환되어 무료 서비스 제공은 일괄 정지되고, 이용자는 고객센터를 통하여 일반계정으로 전환요청을 할 경우 무료 서비스를 이용할 수 있습니다. 이 경우 회사는 무료 서비스 제공 정지로 인해 이용자에게 발생한 손해에 대해서는 책임을 지지 않습니다.</p>
<p>⑤ 본 약관의 내용 중 유료 서비스를 전제로 한 규정은 무료 서비스에 대해 적용되지 않습니다(예 : 제26조에 따른 환불의 경우 무료 서비스 기간은 기 이용요금의 일할계산 기간 산정에 포함되지 않습니다)</p>
 
<p class="mg20t">제15조(서비스 제공 시간 및 장소)
</p><p>① 회사는 매주 월요일부터 금요일까지 서비스를 제공하되, 서비스 제공 시간은 오전 8시부터 오후 3시30분까지로 합니다. 다만, 이용자는 평일 오전 8시부터 오후 6시까지 제6조 제1항에서 정한 방법으로 서비스와 관련된 제반 사항을 요청할 수 있고, 회사는 위 요청을 받은 날로부터 3일 이내에 요청 사항을 처리한 후 제6조 제1항에서 정한 방법으로 처리 사항을 통지하여야 합니다. </p>
<p>② 회사는 서비스 상품 종류별로 서비스 제공 시간을 달리 정할 수 있으며, 이 경우 그 내용을 사이트에 공지합니다. </p>
<p>③ 회사는 사이트 또는 회사가 지정하는 장소에서 이용자에게 서비스를 제공합니다. </p>
<p>④ 회사는 다음 각 호 중 어느 하나에 해당하는 사유가 발생한 경우 서비스 제공을 일시 정지할 수 있고, 이 경우 이로 인해 발생한 이용자의 손해에 대해 회사는 손해배상의무를 부담하지 않습니다. </p>
<p>1. 설비 보수, 서버 정기 점검 등의 사정이 발생한 경우 </p>
<p>2. 기간통신사업자가 통신 서비스를 중지한 경우 </p>
<p>3. 정전, 설비 장애, 기타 사유로 정상적인 서비스가 불가능하게 된 경우 </p>
<p>⑤ 회사는 제4항 제1호의 사유가 발생한 경우 사전에 제6조에서 정한 방법으로 그 사유 및 기간을 게시하여야 하고, 제4항 제2호, 제3호의 사유가 발생하거나 부득이한 사정으로 사전 통지를 하지 못한 경우에는 사후통지로 갈음할 수 있습니다. </p>
 
<p class="mg20t">제16조(서비스 내용의 추가, 변경) </p>
<p>① 회사는 운영 또는 기술상의 필요에 따라 서비스 내용을 추가, 변경할 수 있고, 서비스 내용이 추가, 변경된 경우에는 추가, 변경되는 내용을 제6조에서 정한 방법에 따라 미리 공지하여야 합니다. </p>
<p>② 서비스 내용이 추가 또는 변경된 경우 이용계약 체결 시 회사가 이용자에게 제공된 각종 혜택은 변경 후 서비스에 적용되지 않을 수 있습니다. </p>
<p>③ 이용자가 서비스 상품 가입 후 7일 이내에 서비스 상품의 변경을 신청할 경우에는 서비스 상품 변경에 따른 차액 전액을 반환하고, 7일 이후에 변경을 신청할 경우에는 제26조 제3항 제2호의 기 이용요금을 공제한 나머지 금액을 반환합니다. 이 경우 회사는 변경 신청한 서비스 상품의 이용대금을 공제하고 반환합니다. </p>
<p>④ 이용자가 서비스 상품 변경을 신청한 후 제26조 제1항에 따라 이용계약을 해지할 경우 환불 대상 금액은 변경 전 서비스 상품 금액과 변경 후 서비스 상품 금액 중 고액을 기준으로 제26조 제3항에 따라 산정합니다. </p>
 
<p class="mg20t">제17조(이용요금의 납부 등) </p>
<p>① 이용자는 현금, 신용카드, ARS를 통해 이용요금을 납부할 수 있습니다. 다만, ARS 결제 시에는 결제 대금 액수에 제한이 있을 수 있습니다. </p>
<p>② 이용자가 이용요금을 현금으로 납부하는 경우에는 아래 계좌에 납부하여야 하고, 납부 즉시 입금 사실을 회사에 통보하여야 합니다. </p>
국민은행 : 421701-04-216870 예금주 : (주)머니랩솔루션즈 <p></p>
<p>③ 결제 내역에 대한 영수증은 이용자가 발행을 신청하는 경우에 한하여 발행합니다. </p>
<p>④ 회사는 이용요금이 과다 납부되거나 잘못 납부된 경우 이용자의 동의를 얻어 과납 또는 오납된 이용요금을 반환(환불)하는 대신 그 금액에 상당하는 기간 동안 서비스를 연장하여 제공할 수 있습니다. </p>
 
<p class="mg20t">제18조(이용요금 등의 환불) </p>
<p>① 이용자는 다음 각 호 중 어느 하나에 해당하는 사유가 발생한 경우 회사에 이용요금의 환불을 요청할 수 있고, 회사는 이용자로부터 환불 요청을 받은 날로부터 15일 이내에 환불 사유에 해당하는지 여부를 검토한 후 이용자에게 환불 여부를 통보하여야 하며, 환불 사유에 해당하는 경우에는 환불 여부에 대한 통보를 한 날로부터 7일 이내에 환불을 하여야 합니다. </p>
<p>1. 이용자가 이용요금을 과납 또는 오납한 경우 </p>
<p>2. 회사의 귀책사유로 회사가 서비스를 제공하지 못한 경우 
</p><p>3. 이용자의 책임 없는 사유로 이용자의 서비스 이용이 불가능하게 된 경우 </p>
<p>② 제1항의 경우 회사는 이용자가 이용요금을 미납한 경우 환불하여야 할 금원에서 미납 이용요금을 우선 공제하고 반환합니다. </p>
<p>③ 이용자는 환불 요청시 이용자 본인 명의의 통장 사본을 회사에 제출하여야 합니다. 다만, 이용자가 신용카드를 통해 이용요금을 납부하여 취소가 불가능하거나 어려운 경우 회사는 입금된 카드 결제 대금 중 기 이용요금을 공제한 나머지 금원을 이용자에게 현금으로 반환합니다. </p>
<p>④ 회사가 이용자에게 제공하는 마일리지는 환불되지 않으며, 마일리지는 제공받은 시점으로부터 12개월간 사용이 가능합니다. </p>
 
<p class="mg20t">제19조(이용자의 고지 의무) </p>
<p>이용자는 제8조에 따라 이용신청시 회사에 제출한 이용자의 정보가 변경된 경우에는 변경된 날로부터 7일 이내에 제6조 제1항에서 정한 방법에 따라 변경된 내용을 회사에 고지하여야 합니다. </p>
 
<p class="mg20t">제20조(이용계약의 변경 신청) </p>
<p>① 이용자는 다음 각 호 중 어느 하나에 해당하는 사유가 발생한 경우 회사가 정한 절차에 따라 변경 신청을 할 수 있습니다. </p>
<p>1. 서비스 상품의 변경을 원할 경우 </p>
<p>2. 서비스 상품 선택 사항에 대한 추가 또는 변경을 원할 경우 </p>
<p>3. 이용요금 납입 방법의 변경을 원할 경우 </p>
<p>② 이용자가 제1항에서 정한 변경 신청을 하지 않은 경우, 이로 인한 불이익에 대해 회사에서는 책임을 지지 않습니다. </p>
 
<p class="mg20t">제21조(권리, 의무의 승계) </p>
<p>① 이용자에게 다음 각 호 중 어느 하나에 해당하는 사유가 발생한 경우 이용계약에 따른 권리, 의무가 승계된 것으로 간주되고, 승계인은 승계 사유가 발생한 날로부터 7일 이내에 이를 회사에 고지하여야 합니다. 다만, 승계인은 승계 사유가 발생한 날로부터 7일 이내에 회사에 이용계약의 해지 통보를 하고, 이용계약을 해지할 수 있습니다. </p>
<p>1. 상속 </p>
<p>2. 합병, 분할, 영업양도 </p>
<p>② 제1항 단서의 기간 동안 승계인이 서비스를 1회라도 이용한 경우 승계인은 이용계약을 해지할 수 없습니다. </p>
<p>③ 이용자의 권리, 의무가 승계된 경우 회사는 이용자 또는 승계인에게 권리, 의무 승계에 대한 자료를 요청할 수 있고, 이용자 또는 승계인은 회사의 요청에 응하여야 합니다. </p>
<p>④ 제1항의 사유에도 불구하고 회사가 승계인에 대한 서비스 제공이 적절하지 않다고 판단한 경우 회사는 승계사유가 발생한 날로부터 15일 이내에 승계인에게 이용계약에 대한 해지 통보를 하고, 이용계약을 해지할 수 있습니다. </p>
<p>⑤ 이용자의 권리, 의무가 승계된 경우 승계 사유가 발생한 날까지의 이용요금은 이용자와 승계인이 연대하여 납부하여야 하고, 승계 사유가 발생한 다음날부터 발생한 이용요금은 승계인이 납부하여야 합니다. </p>
<p>⑥ 제1항 단서에 따라 승계인이 이용계약의 해지 통보를 한 경우 승계 사유가 발생한 날로부터 해지 요청이 회사에 도달한 날까지의 이용요금은 이용자가 납부하여야 합니다. </p>
 
<p class="mg20t">제22조(게시물 등의 저작권 및 관리) </p>
<p>① 회사가 작성한 문서 또는 사이트에 게시한 게시물, 회사가 제공한 정보 등에 대한 저작권 등 일체의 권리는 회사에게 귀속합니다. </p>
<p>② 회사는 이용자의 게시물에 다음 각 호 중 어느 하나에 해당하는 내용이 포함되어 있는 경우 별도의 통보 없이 게시물을 삭제할 수 있습니다. </p>
<p>1. 다른 이용자나 제3자, 회사의 명예, 신용을 훼손, 비방하거나 그 업무를 방해하는 내용. </p>
<p>2. 법령에 위반되거나 공공질서 또는 미풍양속에 위반되는 내용. </p>
<p>3. 다른 이용자 또는 제3자, 회사의 저작권 기타 권리를 침해하는 내용. </p>
<p>4. 이용자의 영업 등의 목적을 위해 광고, 홍보하는 내용. </p>
<p>5. 허위의 사실 또는 허위의 사실일 가능성이 높은 내용. </p>
<p>6. 이용계약의 목적에 반하거나 기타 회사에서 정한 규정에 위반되는 내용. </p>
<p>③ 이용자는 다른 이용자의 게시물에 제2항 각 호 중 어느 하나에 해당하는 내용이 포함되어 있는 경우 그 사실을 소명하여 회사에 해당 게시물 등의 삭제를 요청할 수 있고, 회사는 이용자의 요청이 타당하다고 판단되는 경우 해당 게시물을 삭제할 수 있습니다. </p>
 
<p class="mg20t">제23조(이용자의 의무) 
</p><p>① 이용자는 관련 법령, 이 약관, 회사가 정한 기타 이용조건, 회사가 서비스와 관련하여 공지 또는 통지한 사항을 준수하여야 합니다. </p>
<p>② 이용자는 다음 각 호 중 어느 하나에 해당하는 사유를 하여서는 안 됩니다. </p>
<p>1. 다른 이용자의 ID를 사용하여 서비스를 부정 이용하거나 다른 이용자의 정보를 도용하는 행위 </p>
<p>2. 개인정보를 허위로 기재 또는 등록하여 이용신청을 하거나 허위로 변경하는 행위 </p>
<p>3. 회사가 정한 정보 이외의 정보(컴퓨터프로그램 등)를 송신 또는 게시하거나 회사가 정한 정보를 임의로 변경하는 행위 </p>
<p>4. 회사가 작성한 저작물, 회사가 제공하는 정보 등을 가공, 판매하거나 이를 상업적 목적으로 이용하는 행위 </p>
<p>5. 회사가 작성한 문서 또는 사이트에 게시한 게시물, 회사가 제공한 정보를 회사의 사전 동의 없이 복제, 공연, 공중송신, 전시, 배포, 대여, 2차적 저작물 작성의 방법으로 침해하는 행위 </p>
<p>6. 제22조 제2항 각 호의 내용이 포함된 게시물을 게재하는 행위 </p>
<p>7. 서비스의 안정적 운영을 방해할 수 있는 다량의 정보를 전송하거나 수신자의 의사에 반하여 광고성 정보를 전송하는 행위 </p>
<p>8. 정보통신설비의 오작동이나 정보 등의 파괴 및 혼란을 유발시키는 컴퓨터 바이러스 감염 자료를 등록 또는 유포하는 행위 </p>
<p>9. 관련 법령에 위반되거나 외설, 욕설 또는 폭력적인 메시지 등 미풍양속이나 사회통념에 반하는 정보를 공개 또는 게시하는 행위 </p>
<p>10. 범죄행위와 관련된 정보를 공개 또는 게시하는 행위 </p>
<p>11. 기타 회사의 업무를 방해하는 일체의 행위 </p>
<p>③ 이용자는 이용계약에 따른 권리, 의무를 제3자에게 처분(양도, 대여, 증여, 인수 등 일체의 처분행위 포함)하거나 담보 등의 목적으로 제공할 수 없습니다. 다만, 제21조 제1항에 의한 권리, 의무의 승계는 제외합니다. </p>
 
<p class="mg20t">제24조(서비스 이용의 일시 정지) </p>
<p>① 이용자가 서비스 이용의 일시 정지를 신청한 경우 회사는 이용자의 서비스 이용을 일시 정지하여야 하고, 일시 정지 기간 동안 이용요금은 발생하지 않습니다. </p>
<p>② 이용자는 이용계약 기간 중 최대 3회에 한하여 일시 정지를 신청할 수 있고, 서비스 일시 정지 기간은 1회당 14일을 초과할 수 없으며, 일시 정지 기간의 종료된 다음날부터 이용자에 대해 기존 서비스가 동일하게 제공됩니다.</p>
<p>③ 서비스 일시 정지 신청의 취소는 신청 당일에만 가능하고, 이 경우 1일 이용요금이 차감됩니다. </p>
<p>④ 이벤트 기타 사유로 제공된 무료 서비스 기간 중에는 일시 정지를 신청할 수 없습니다. </p>
 
<p class="mg20t">제25조(신용정보의 조회) </p>
<p>회사는 이용자가 이용요금 납부를 지체하는 등 이용자의 신용을 확인할 필요가 있을 때에는 관련 법령이 정하는 바에 따라 신용조회회사 또는 신용정보집중기관의 정보를 이용할 수 있고, 이용자는 이에 동의합니다. </p>
 
<p class="mg20t">제26조(이용자의 요청에 따른 해지 및 환불) </p>
<p>이용자는 홈페이지 자료실에서 있는 양식을 다운받아 E-mail로 발송하는 방법으로 이용계약의 해지를 요청할 수 있고, 위 해지의 의사표시가 회사에 도달한 날로부터 7일 이후에 이용계약은 해지된 것으로 봅니다.</p> 
<p>② 이용자는 이용계약에 대한 해지를 요청할 경우 이용자 본인 확인을 위한 신분증 사본(주민등록번호 제외), 통장사본, 주소를 알 수 있는 자료를 첨부하여 제출하여야 합니다. </p>
<p>③ 제13조 제1항 제1호 내지 제4호의 서비스 이용자가 제1항에 따른 이용해지를 요청한 경우 회사는 아래 각 호의 금원을 모두 공제한 나머지 금원을 반환합니다. </p>
<p>1. 해지수수료 : 가입금액의 10% </p>
<p>2. 기 이용요금 : 기 이용요금은 가입기간(“유료서비스” 기간만을 의미합니다)으로 일할계산한 금액을 공제합니다. </p>
(기 이용요금 공제에 대한 예시) <p></p>
<p>※ 1년 이용요금이 30,000,000원인 이용자가 이용계약을 해지하였는데, 이용계약 기간이 270일인 경우 – 22,191,780원[1일 이용요금 82,192원(=30,000,000원/365일=82,192원)× 270일] 공제 </p>
<p>④ 서비스 이용계약이 해지되거나 서비스 상품이 변경된 경우 회사가 이용자에게 제공한 무료 서비스 기간은 현금이나 사용일수로 보상하지 않습니다. </p>
<p>⑤ 서비스 상품 변경 시 회사가 이용자에게 제공한 무료 서비스 기간은 변경 후 서비스 상품에 적용되지 않을 수 있습니다. </p>
 
<p class="mg20t">제27조(이용계약의 해제/해지) </p>
<p>① 회사는 다음 각 호 중 어느 하나에 해당하는 사유가 발생한 경우 이용자에게 그 시정을 최고하고, 이용자가 최고를 받은 날로부터 7일 이내에 시정을 하지 아니한 경우 이용계약을 해제/해지할 수 있습니다. </p>
<p>1. 이용자가 이용요금을 15일 이상 연체한 경우 </p>
<p>2. 이용자가 제22조 제2항 및 제23조 제2항 각 호에 기재된 게시물을 게시한 경우 </p>
<p>3. 이용자가 제23조 제2항 각 호에 기재된 행위를 한 경우 </p>
<p>4. 이용자가 관련 법령 또는 약관을 위반한 경우 </p>
<p>② 이용자는 다음 각 호 중 어느 하나에 해당하는 사유가 발생한 경우 회사에 그 시정을 최고하고, 회사가 최고를 받은 날로부터 7일 이내에 시정을 하지 아니한 경우 이용계약을 해제/해지할 수 있습니다. </p>
<p>1. 회사가 관련 법령 또는 약관을 위반한 경우 </p>
<p>2. 제14조에 명시한 서비스를 15거래일 이상 제공하지 않은 경우 </p>
<p>③ 회사 또는 이용자는 회사 또는 이용자에게 다음 각 호 중 어느 하나에 해당하는 사유가 발생한 경우 이용계약을 즉시 해제/해지할 수 있습니다. </p>
<p>1. 회사 또는 이용자가 금융기관으로부터 거래정지 처분을 받거나 감독기관 등으로부터 영업취소, 정지 등의 처분을 받은 경우 </p>
<p>2. 회사 또는 이용자가 파산, 회생절차 및 기타 이에 준하는 법적 절차를 신청하거나 신청 당한 경우 </p>
<p>3. 회사 또는 이용자의 재산에 대한 압류, 가압류, 가처분 및 이에 준하는 처분이 이루어진 경우 </p>
<p>4. 회사 또는 이용자가 발행한 어음 또는 수표의 부도가 난 경우 </p>
<p>④ 이용계약의 해제/해지의 의사표시는 제6조 제1항 또는 제26조 제1항에서 정한 방법으로 할 수 있습니다. </p>
<p>⑤ 제1항에서 정한 사유 또는 제3항 중 이용자의 책임 있는 사유로 이용계약이 해제/해지된 경우 이용자가 회사에 지급한 금원은 위약벌로 회사에 귀속됩니다. </p>
<p>⑥ 제2항에서 정한 사유 또는 제3항 중 회사의 책임 있는 사유로 이용계약이 해제/해지된 경우 회사는 제26조 제3항에서 정한 금원을 공제한 나머지 금원을 이용자에게 반환하여야 합니다. </p>
 
<p class="mg20t">제28조(이용계약 해제/해지, 종료의 효과) </p>
<p>① 회사는 이용계약이 해제/해지 또는 종료되는 경우 관련 법령 및 개인정보취급방침에 따라 이용자의 정보를 보유할 수 있는 경우, 기타 이용자가 동의한 경우를 제외하고, 이용자의 나머지 정보를 모두 폐기하여야 합니다. </p>
<p>② 이용계약이 해제/해지 또는 종료된 경우 회사가 이용자에게 제공한 마일리지, 무료 연장 기간, 가입금 할인 등 일체의 혜택은 모두 소멸하고, 회사는 이에 대해 별도로 보상 내지 배상을 하지 아니합니다. </p>
 
<p class="mg20t">제29조(손해배상) </p>
<p>① 회사 또는 이용자는 회사 또는 이용자의 귀책사유로 인해 상대방에게 발생한 손해를 배상하여야 합니다. </p>
<p>② 이용계약의 해제/해지는 손해배상의 청구에 영향을 미치지 아니합니다. </p>
 
<p class="mg20t">제30조(계약기간의 연장) </p>
<p>① 유료 서비스를 1년 이상(이용계약 체결일을 포함하여 365일) 이용한 이용자의 이용계약기간이 종료된 경우 이용자가 회사가 추천한 내용(종목, 매수/매도 신호, 목표가, 보유기간 등)에 따라 거래를 하였음에도 불구하고 계약기간 만료일 청산기준으로 손실이 발생하면 이용자는 게시판에 신청하거나 E-mail을 발송하는 방법으로 회사에 이용계약 기간의 연장을 요청할 수 있습니다. 이 경우 회사는 1년 동안 전에 이용한 서비스와 동일한 서비스를 제공하고, 다만 계약기간의 연장기간은 5년을 초과할 수 없습니다. </p>
<p>② 제1항에도 불구하고 다음 각 호 중 어느 하나에 해당하는 사유가 발생한 경우에는 이용자는 회사에게 이용기간 연장을 요청할 수 없습니다. </p>
<p>1. 회사가 매수 추천 이후 보유 종목에 대한 추가매수 또는 일부 소량매수 등의 대응전략을 제시하여 손실이 회복될 수 있었음에도 불구하고 이용자가 이에 따르지 않아 손실이 발생한 경우. </p>
<p>2. 이용자가 회사의 추천 비중 10% 이하(위 비중은 이용자가 이용신청시 최초 기재한 투자금을 기준으로 판단합니다, 이하 같습니다)의 종목에 대한 매매를 통해 손실이 발생한 경우. </p>
<p>3. 이용자가 회사의 추천 비중 10% 초과 종목에 대한 매매를 통해 손실이 발생하였으나 실제 매매내역에 대한 증빙이 없는 경우. </p>
<p>4. 이용자가 이용계약 신청시 투자금액을 허위로 기재한 경우. </p>
 
<p class="mg20t">제31조(면책) </p>
<p>① 회사는 이 약관에서 별도로 정한 환불 사유를 제외하고 회사가 작성한 문서 또는 사이트에 게시한 게시물, 회사가 제공한 정보 등으로 인해 이용자에게 발생한 손해에 대해서는 책임을 지지 않습니다.</p> 
<p>② 회사는 다른 이용자 또는 제3자가 작성한 문서 또는 사이트에 게시한 게시물, 제공한 정보, 전송한 자료로 인해 이용자에게 발생한 손해에 대해서는 책임을 지지 않습니다. </p>
 
<p class="mg20t">제32조(약관의 일부 무효) </p>
<p>약관의 일부 조항이 관련 법령에 위반되는 등의 사유로 그 법적 효력을 상실한 경우 해당 조항 외의 나머지 조항들은 여전히 유효합니다. </p>
 
<p class="mg20t">제33조(저작권의 귀속 및 이용제한)  </p>
<p>① '(주)머니랩솔루션즈' 작성하여 제공하는 저작물에 대한 저작권 및 기타 지적재산권은 '(주)머니랩솔루션즈'에 귀속합니다.  </p>
<p>② 회원은 '(주)머니랩솔루션즈'를 이용함으로써 얻은 정보를 '(주)머니랩솔루션즈'의 사전승낙 없이 복제, 전송, 출판, 배포, 방송 기타 방법에 의하여 영리목적으로 이용하거나 제3자에게 이용하게 하여서는 안됩니다.  </p>
<p>③ 회원이 서비스에 게재한 게시물, 자료 등에 관한 권리와 책임은 이를 게시한 회원에게 있습니다. “(주)머니랩솔루션즈”는 해당 게시물, 자료 등을 게재한 회원의 동의 없이 이를 영리적인 목적으로 사용하지 아니합니다. 다만, “(주)머니랩솔루션즈”는 회원이 게재한 게시물, 자료 등에 대하여 서비스(“(주)머니랩솔루션즈”와 업무 제휴 관계에 있는 제 3 자의 인터넷 사이트를 포함) 내에 게재할 수 있는 권리를 가집니다.  </p>
<p>④ “(주)머니랩솔루션즈”는 제23조의 의무를 위반하는 내용을 담고 있는 게시물에 대하여 수정 또는 삭제할 권한을 갖습니다</p>
 
<p class="mg20t">제34조(관할법원) </p>
<p>이용계약과 관련하여 발생한 제반 분쟁은 회사 본점 소재지의 법원을 관할법원으로 합니다. </p>
 
<p class="mg20t">부칙</p>
<p>이 약관은 2017년 8월 8일부터 시행되고, 이 약관의 효력 발생 전에 회사와 체결된 이용계약에 대해서도 이 약관이 적용됩니다.</p>		 -->
    </div>
		<div class="agree-check-box">
			<input type="checkbox" name="terms_use" id="terms_use" value="Y">
			<label for="terms_use">위 이용약관에 동의합니다.(필수)</label>
		</div>
	</div>

	<div class="farm-A-agree">
		<h4 class="farm-A-title" >개인정보처리방침</h4>
		<div class="farm-A-agree-box">
			<style>
                .pr_table th, td { border:1px solid #ccc; font-size:12px;text-align:center; padding:3px; font-weight:bold }
            </style>
                   <style>
            
            </style>

@php echo $get_info['privacy']['content'] @endphp

			<!-- <strong style="font-size: 16px; font-weight: 600; color: #222;">갤럭시투자그룹 개인정보처리방침</strong>

<h5 data-lan="kr">1. 수집하는 개인정보의 항목</h5>
<p data-lan="kr">회사는 회원가입, 상담, 서비스 신청 등을 위해 아래와 같은 개인정보를 수집하고 있습니다.</p>
<p data-lan="kr">
- 수집항목 : 아이디, 별명, 패스워드, 성명, e-mail, 휴대전화, 생년월일, 결혼, 추천인 아이디 <br/>
- 수집방법 : 홈페이지(회원가입), 이벤트 응모, 생성정보 수집 툴을 통한 수집<br/>
</p>

<h5 data-lan="kr">2. 개인정보의 수집 및 이용목적</h5>
<p data-lan="kr">회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.</p>
<p data-lan="kr">
1) 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산<br/>
구매 및 요금 결제, 물품배송 또는 청구지 등 발송<br/><br/>
2) 회원 관리<br/>
회원제 서비스 이용에 따른 본인확인, 개인 식별, 불량회원의 부정 이용 방지와 비인가 사용 방지, 가입 의사 확인, 연령확인, 불만처리 등 민원처리, 고지사항 전달<br/><br/>
3) 마케팅 및 광고 활용<br/>
신규 서비스 개발 및 특화, 이벤트 등 광고성 정보 전달, 인구 통계학적 특성에 따른 서비스 제공 및 광고게재, 접속 빈도 파악, 회원의 서비스 이용에 대한 통계
</p>

<h5 data-lan="kr">3. 개인정보의 제공 및 공유</h5>
<p data-lan="kr">회사는 회원의 정보를 “2. 개인정보의 수집 및 이용 목적” 에서 고지한 범위 내에서 사용하며, 회원의 사전동의 없이 동 범위를 초과하여 이용하거나 회원의 개인정보를 외부에 공개하지 않겠습니다. </p>

<h5 data-lan="kr">4. 수집한 개인정보의 취급위탁</h5>
<p data-lan="kr">회사는 회원의 동의 없이 회원의 개인정보 취급을 외부 업체에 위탁하지 않습니다. 향후 그러한 필요가 발생할 경우, 위탁 대상자와 위탁 업무 내용에 대해 회원에게 고지하고 필요한 경우 사전동의를 받도록 하겠습니다.</p>

<h5 data-lan="kr">5. 개인정보의 보유 및 이용기간</h5>
<p data-lan="kr">원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다.<br/>
단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 정보를 보존 합니다.</p>

<p data-lan="kr">1) 회원 탈퇴시 보존 개인 정보
- 보존 항목 : 필명, 탈퇴일, 이름, 핸드폰 번호, 탈퇴사유<br/>
- 보존 근거 : 불량이용자의 재가입 방지, 명예훼손 등 권리침해 분쟁 및 수사 협조<br/>
- 보존 기간 : 회원탈퇴 후 1개월
</p>

<p data-lan="kr">2) 대금결제 관련 보존 개인 정보
- 보존 항목 : 대금결제 이력
- 보존 근거 : 전자상거래등에서의 소비자 보호에 관한 법률
- 보존 기간 : 회원탈퇴 후 5년
</p>

<h5 data-lan="kr">6. 개인정보 파기절차 및 방법</h5>
<p data-lan="kr">회사는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 파기절차 및 방법은 다음과 같습니다.</p>

<p data-lan="kr">1) 파기절차 회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 회원정보 DB에서내부 방침 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기됩니다. 동 개인정보는 법률에 의한 경우가 아니고서는 다른 목적으로 이용되지 않습니다.</p>

<p data-lan="kr">2) 파기방법 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기하고 전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.</p>

<h5 data-lan="kr">7. 이용자 및 법정대리인의 권리와 그 행사방법</h5>
<p data-lan="kr">이용자 및 법정대리인은 언제든지 등록되어 있는 자신의 개인정보를 조회하거나 수정할 수 있으며 가입 해지를 요청할 수도 있습니다.<br/>
이용자의 개인정보 조회·수정을 위해서는 "회원정보변경"을, 가입 해지 시에는 "회원탈퇴"를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다.<br/>
혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체 없이 조치하겠습니다.<br/>
귀하가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다.<br/>
회사는 이용자의 요청에 의해 해지 또는 삭제된 개인정보는 "회사가 수집하는 개인정보의 보유 및 이용기간"에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.</p>

<h5 data-lan="kr">8. 개인정보 자동 수집 장치의 설치, 운영 및 그 거부에 관한사항</h5>
<p data-lan="kr">회사는 회원님에게 특화된 맞춤 서비스를 제공하기 위해서 회원님의 정보를 저장하고 수시로 불러오는 '쿠키(cookie)'를 사용합니다.<br/>
쿠키는 웹사이트를 운영하는데 이용되는 서버가 귀하의 브라우저에 보내는 아주 작은 텍스트 파일로서 귀하의 컴퓨터 하드디스크에 저장됩니다.</p>

<p data-lan="kr">1) 쿠키의 사용 목적<br/>
회원과 비회원의 접속 빈도나 방문 시간 등을 분석, 이용자의 취향과 관심분야 파악 및 자취 추적, 각종 이벤트 참여 정도 및 방문 회수 파악 등을 통한 타겟 마케팅 및 개인 맞춤 서비스를 제공하기 위하여 사용됩니다.</p>


<p data-lan="kr">2) 쿠키의 설치 및 거부 방법<br/>
귀하는 쿠키 설치에 대한 선택권을 가지고 있습니다.<br/>
따라서, 귀하는 웹 브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수 있습니다.<br/>
- 설정방법 예) 인터넷 익스플로어의 경우 웹 브라우저 상단의 [도구 > 인터넷 옵션 > 개인정보]<br/>
단, 귀하께서 쿠키 설치를 거부하였을 경우 서비스 제공에 어려움이 있을 수 있습니다.</p>

<h5 data-lan="kr">9. 개인정보에 대한 민원처리 및 분쟁해결</h5>
<p data-lan="kr">회사는 개인정보보호와 관련하여 회원님들의 의견 수렴과 불만처리를 위하여 모든 절차와 방법을 마련하고 있습니다. <br/>
회원님들은 하단에 명시한 '개인정보관리책임자'를 참고하여 전화나 메일을 통하여 불만사항을 신고할 수 있고, 온라인 고객센터를 이용하여 보다 편리하게 민원을 접수하실 수 있습니다.<br/>
회사는 이용자들의 신고사항에 대하여 신속하고 충분한 답변을 드리기 위해 최선을 다하고 있습니다.</p>

<p data-lan="kr">민원처리부서 : 회사 고객센터 (전화 1644-1870)</p>

<p data-lan="kr">필요하신 경우 정부에서 설치하여 운영중인 아래의 기관에 불만처리를 신청할 수 있습니다.</p>

<p data-lan="kr">분쟁조정기관<br/>
- 개인정보 침해신고센터 (http://privacy.kisa.or.kr, 전화 118 ARS 내선 2번)<br/>
- 개인정보 분쟁조정위원회 (http://privacy.kisa.or.kr/kor/main.jsp, 전화 118)<br/>
- 정보보호마크 인증위원회 (http://www.eprivacy.or.kr, 전화 02-550-9531~2)<br/>
- 경찰청 (http://www.police.go.kr)</p>

<h5 data-lan="kr">10. 개인정보관리책임자</h5>
<p data-lan="kr">회사는 회원님들께서 좋은 정보를 안전하게 이용하실 수 있도록 최선을 다하고 있습니다. <br/>
만일 개인정보를 보호하는데 있어 회원님께 고지한 사항들에 반하는 사고가 발생할 경우 개인정보관리책임자가 책임을 집니다. <br/>
단 이용자 개인정보와 관련한 필명의 비밀번호에 대한 보안유지책임은 해당 이용자 자신에게 있으므로 '개인정보보호를 위한 기술적-관리적 대책' 항에서 명시한 것과 같이 공공장소에서 온라인상에서 접속해 있을 경우에는 각별히 유의하셔야 합니다. <br/>
회사는 개인정보에 대한 의견수렴 및 불만처리를 담당하는 개인정보 관리책임자 및 담당자의 연락처는 아래와 같습니다.</p>

<p data-lan="kr">개인정보관리 책임 담당자<br/>
이 름 : 이재인 <br/>
전 화 : 1644-1870</p>

<p data-lan="kr">개인정보보호정책 시행일자 : 2017년 08월 08일</p>


<h5 data-lan="kr">[개인정보의 제 3자 제공 동의] (선택)</h5>

<p data-lan="kr">개인정보의 제3자 제공 동의 제공받는 자, 제공받는자의 개인정보 이용목적, 제공하는 개인정보의 항목, 제공받는 자의 개인정보 보유 및 이용기간</p>
<br/>

<table data-lan="kr" class="pr_table">
<tr>
	<th>제공받는 자	</th>
	<th>이용목적</th>
	<th>제공 항목</th>
	<th>보유/이용기간</th>
</tr>
<tr>
	<td>(주)노마드솔라<br/>
	(주)썬메딕<br/>
	</td>
	<td>주식정보 서비스 제공</td>
	<td>성명,연락처</td>
	<td>2년</td>
</tr>
</table>

<p data-lan="kr">정보주체는 개인정보 수집 및 이용에 대한 동의를 거부할 수 있으며, 동의 거부 시 주식정보 서비스를 이용할 수 없습니다.</p>

<p data-lan="kr">※ 본 동의를 거부할 수 있으나, 거부하는 경우에는 상품 소개 및 가입상담 서비스, 무료체험서비스,주식정보 제공이 제한될 수 있습니다.<br/>
※ 동의하시더라도 당사 고객센터를 통해 동의를 철회하거나 가입권유 목적의 연락에 대한 중단을 요청하실 수 있습니다.</p> -->


                </div>

                <div class="agree-check-box">
                    <input type="checkbox" name="privacy" id="privacy" value="Y">
                    <label for="privacy" >위 개인정보처리방침에 동의합니다.(필수)</label>
                </div>
                <div class="agree-check-box">
                    <input type="checkbox" name="provision" id="provision" value="Y">
                    <label for="provision" >위 개인정보의 제3자 제공에 동의합니다. (선택)</label>
                </div>
            </div>

            <div class="farm-A-btn-wrap">
		
	    	<span class="farm-A-half">
			    <a href="javascript:history.back()" class="farm-A-btn-circle farm-A-big">
                    <span class="farm-A-big-txt">BACK</span>
                    <span class="farm-A-small-txt">이전으로</span>
                </a>
                <a href="javascript:mem_agree_ok()" class="farm-A-btn-circle farm-A-big farm-A-highlight">
                    <span class="farm-A-big-txt">JOIN</span>
                    <span class="farm-A-small-txt">회원가입</span>
                </a>
            </span>
            </form>
        </div>
    </div>
</div>


@endsection

@section('script')

<script type="text/javascript">
    // 약관동의
    function mem_agree_ok(){

        var chk = 0;
        $.each({'terms_use':'이용약관','privacy':'개인정보처리방침'},function(key,value){
            if(!$("#"+key).is(":checked")){
                alert(value+"에 동의하셔야 회원가입을 하실 수 있습니다. \n\n동의에 체크해 주시기 바랍니다.");
                chk = 1;
                return false;
            }
        });

        if (chk == 1) return false;

        $("#join_agree").submit();
        
    }
</script>
@endsection