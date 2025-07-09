@extends('layouts.app')
@section('content')
<h3 class="text-center mb-4">Tạo Đơn Review Map</h3>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Lỗi!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif
    <!-- Order form -->
    <div class="card">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('postOrder') }}" method="POST" enctype="multipart/form-data" id="form-order">
                    @csrf
                    <label class="form-label"><b><u>Bước 1:</u></b> Nhập link Google maps của bạn</label>
                    <input type="text" class="form-control" id="map_link" name="map_link" placeholder="https://goo.gl/maps/......."  value="{{ old('url_maps') }}" onBlur="sumPrice()">
                    @error('map_link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="quantity" class="form-label"><b><u>Bước 2:</u></b> Nêu những ý, từ khóa bạn muốn có trong nội dung review, để thành viên viết review sát hơn.</label>
                        <input type="text" class="form-control" id="content" name="content" placeholder="nhân viên, menu, không gian, chất lượng dv ..." onBlur="sumPrice()"  value="{{ old('content') }}">
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label"><b><u>Bước 3:</u></b> Nhập số lượng đánh giá 5* cần mua</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Số lượng mua" value="1" onBlur="sumPrice()">
                    </div>

                    <div class="mb-3">
                        <p>★ <b><u>Nếu muốn gửi nội dung, ảnh riêng? (+500đ/1 review)</u></b>  <br>- B1: Bạn tải file ảnh lên <u><b><a href="https://drive.google.com/drive/u/0/home"target="_blank">GG Driver</a></u></b><br>- B2: Lấy Link file ảnh & Nội dung lưu vào <u><b><a href="https://docs.google.com/spreadsheets/u/0/create?"target="_blank">GG Sheets</a></u></b><br>- B3: <b><u>Lấy link chia sẻ công khai</u></b> dán vào ô bên dưới.<br> - LƯU Ý: ảnh & nội dung k trùng lặp, Số lượng gửi phải gấp đôi số lượng Oder</p>
                        <input type="text" class="form-control" id="drive_link" name="drive_link" placeholder="https://docs.google.com/......." onBlur="sumPrice()"  value="{{ old('drive_link') }}">
                        @error('drive_link')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="text-center">
                            <h4 class="text-primary">Tổng tiền: <span class="total_price text-danger">0</span></h4>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Bước 4: Tạo Tiến Trình</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Rules / FAQ -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="card mt-5">
                <div class="card-body">
                <h3><span style="color:#ff0000;"><strong>1. Quy trình hoạt động của hệ thống mua đánh giá google maps.</strong></span></h3>

    <ul>
        <li>Sau khi khách hàng đặt đơn hàng tăng đánh giá maps, hệ thống sẽ tự động phân phối nhiệm vụ đánh giá maps cho các thành viên thực hiện trong vòng 5 giờ. Các review sẽ được kiểm tra và cập nhật trạng thái trong mục lịch sử đơn hàng. Nếu đánh giá không hiển thị, khách hàng có thể yêu cầu bảo hành</li>
        <li>Nhà Q/c oder đơn xong <strong> Đang chờ </strong></li>
        <li>Admin duyệt đơn vào hàng<strong> </strong><strong> Chờ chạy .</strong><strong> </strong>Web cứ 5 tiếng <strong> Đang phân phối </strong> 1 Maps / 1 nhiệm vụ đến thành viên. Có nghĩa là 1 maps sẽ chỉ tăng tối đa được 2 đến 3 đánh giá /1 ngày . (phù hợp vs thuật toán review tự nhiên của google maps)
        <ul>
        <li>Các thành viên nhận job, làm <strong> Đang thực hiện  </strong>và báo cáo <strong> Đã báo cáo </strong>
        <ul>
            <li>Admin check báo cáo,
            <ul>
            <li>Nếu review hiển thị thì update trạng thái <strong> Hoàn thành </strong> (Nhà Q/c vào check, nếu khôn hiển thị thì ấn bảo hành) </li>
            <li>Nếu review không hiển thị thì đơn sẽ được về chế độ phân phối tiếp. <strong> Chờ chạy </strong><strong>  =&gt; </strong><strong> Đang phân phối </strong></li>
            </ul>
            </li>
        </ul>
        </li>
        </ul>
        </li>
        <li>Vòng lặp như vậy cho đến khi done Job <strong> Hoàn thành </strong></li>
        <li>Nếu 1 maps review quá 10 lần không lên, maps đó sẽ bị đẩy ra hàng chờ <strong>"Maps đang dính spam"</strong> và 7 ngày sau sẽ tự động được kích hoạt lại để chạy tiếp.</li>
        <li>Việc quan trọng nhất của bạn sau đó là để ý mục lịch sử, và ấn bảo hành với những đánh giá bị mất.</li>
    </ul>

    <h3><span style="color:#ff0000;"><strong>2. Hướng dẫn cách kiểm tra và bảo hành những review maps trong mục lịch sử.</strong></span></h3>

    <p>Mọi đánh giá maps đều được bảo hành 30 ngày kể từ ngày review đó hiển thị trên Maps của bạn.<br />
    Google quét chất lượng review sau 7, 14, và 21 ngày, do đó chúng tôi cung cấp bảo hành 1 tháng nhằm đảm bảo những đánh giá được tạo ra trên Maps của bạn sẽ ổn định qua các đợt kiểm tra này. thời gian bảo hành được tính từ <strong><u>ngày review đó hiển thị.</u>  (Nội dung đánh giá google maps "mới" vẫn sẽ tiếp tục dc bảo hành 30 ngày)</strong></p>

    <p>Nút bảo hành của từng review chỉ hiện trong 30 ngày và auto mất nút sau 30 ngày, tính từ <u><strong>ngày hoàn thành</strong></u> của review đó trong mục <u>lịch sử đơn</u> (kéo sang bên phải) .</p>

    <p><strong>Cách kiểm tra review:</strong> ( trên máy tính bàn, laptop )</p>

    <ul>
        <li><strong>B1:</strong> Vào mục lịch sử đơn, Search, lọc toàn bộ đánh giá của maps cần check, các bạn có thể lọc theo ID maps, hoặc link maps.</li>
        <li><strong>B2:</strong> Mở maps load xem toàn bộ những đánh giá của maps trong 30 ngày gần nhất.</li>
        <li><strong>B3:</strong> Copy nội dung review và<strong> Ctrl F</strong> tìm bên maps .
        <ul>
        <li>Review hiển thị thì oke. </li>
        <li>Review bị mất thì bạn quay sang mục lịch sử ấn vào nút <strong> Bảo hành </strong>
        <ul>
            <li>Nếu admin check mà thấy đánh giá đó vẫn hiển thị thì sẽ<strong>  Từ chối bảo hành </strong> ( Ghi chú có kèm link chia sẻ của đánh giá đó)</li>
            <li>Nếu admin check thấy review đó bị mất thì sẽ <strong>đồng ý bảo hành</strong> =&gt; đơn sẽ chuyển qua trạng thái<strong> </strong><strong> Chờ chạy </strong><strong> =&gt; </strong><strong> Đang phân phối </strong><strong>  =&gt; </strong><strong> Hoàn thành </strong></li>
        </ul>
        </li>
        </ul>
        </li>
    </ul>

    <p><strong>LƯU Ý:</strong> Vui lòng check kỹ trước khi ấn bảo hành, không bấm bừa, không spam, Vì nút bảo hành sẽ bị mất khi bị admin từ chối bảo hành (review vẫn hiển thị) . <u>Khi bạn ấn bảo hành, web sẽ check lại và xử lý trong 24h, Nếu review đó bị  </u><u>từ <strong>chối bảo hành</strong> </u><u> Nhưng bạn cho rằng chúng tôi check sai, hãy khiếu nại trong vòng 24h. quá 24h sẽ k dc xử lý</u></p>

    <h3><span style="color:#ff0000;"><strong>3. Những lưu ý khi mua đánh giá google.</strong></span></h3>

    <ul>
        <li>Bảo hành review 1 tháng.</li>
        <li>Không hỗ trợ rút tiền khi đã nạp vào web</li>
        <li>Nên mua ít nhất 5 review /1 lần oder. như vậy review sẽ chất lượng hơn</li>
        <li>Không được oder đè nhiều đơn cùng 1 maps, đơn chạy xong mới oder tiếp</li>
        <li>Quý khách chủ động mua đánh giá google maps và quản lý đơn hàng tại mục <u><strong>Lịch Sử Đơn</strong></u></li>
        <li>Không hỗ trợ maps ngoại, maps cờ bạc, nam phụ khoa, phòng khám..</li>
        <li>Thời gian bảo hành là 30 ngày, tính từ ngày hoàn thành mới nhất của đơn đó.</li>
        <li>Nội dung đánh giá trên maps bị mất hiển thị, hãy ấn bảo hành. chúng tôi sẽ check lại và xử lý vấn đề.</li>
        <li>Các thành viên sẽ tự nghĩ nội dung phù hợp dựa trên <u><strong>Bước 3: Mô tả dịch vụ maps bạn cung cấp</strong></u> để review cho maps</li>
        <li>Nếu các bạn muốn mua review, nội dung cá nhân tự gửi, thì file nội dung các bạn nên tự nghĩ, hoặc dùng AI để tạo review sẽ bền hơn., chứ đừng copy ở maps khác, vì nếu copy sau này GG quét sẽ rất dễ bị die.</li>
        <li>Đơn review maps sau khi oder sẽ được admin duyệt và phân phối đến các thành viên trong vòng 24h tốc độ chạy 2 - 3 review / 1 maps / 1 ngày</li>
        <li>Trong quá trình tăng đánh giá gg map, Maps có người review thì quý khách hãy like, và trả lời các bài đánh giá đó, để hạn chế và tránh bị tụt khi google quét.</li>
        <li>khi đã mua dịch vụ đánh giá 5 sao google maps trên <strong><a href="https://danhgiamaps.vn/">danhgiamaps.vn</a></strong> quý khách vui lòng không mua bên khác (và ngược lại) . Chúng tôi sẽ nhận &amp; chịu trách nhiệm bảo hành với mọi review 5* xuất hiện trong time chạy.</li>
        <li>Toàn bộ hệ thống dịch vụ đánh giá google map của <strong><a href="https://danhgiamaps.vn/">danhgiamaps.vn</a></strong> đều Auto, vậy nên mọi người có thể tự chủ động tự nạp tiền, ấn oder, theo dõi, quản lý, ấn bảo hành các review của mình tại mục "Lịch sử đơn"</li>
        <li>Web không bán dịch vụ review google map giá rẻ, chúng tôi cung cấp dịch vụ chất lượng, bảo hành uy tín. Mang lại sự ổn định, tiện lợi, tiết kiệm time, an toàn, sòng phẳng cho bạn.</li>
    </ul>

    <h3><span style="color:#ff0000;"><strong>4. Những vấn đề web không bảo hành:</strong></span></h3>

    <ul>
        <li>Website không yêu cầu quyền truy cập hay quản trị maps, doanh nghiệp của bạn, nên những vấn đề hi hữu không mong muốn sảy ra ví dụ như die maps chúng tôi sẽ k chịu trách nhiệm.</li>
        <li>Nội dung đánh giá maps do thành viên trong cộng đồng nhận nhiệm vụ, nhìn vào <u><strong>Bước 2: Mô tả dịch vụ maps bạn cung cấp</strong></u> để tự nghĩ nội dung đánh giá cho phù hợp. Vậy nên việc thi thoảng có một số review maps có nội dung chưa chuẩn lắm, vẫn có thể chấp nhận được thì chấp nhận nhé. Còn những review nội dung sai lệch hoàn toàn với chủ đề maps, không thể chấp nhận được, thì chúng tôi sẽ tìm cách để sửa nội dung đó cho bạn.</li>
    </ul>

    <h3><span style="color:#ff0000;"><strong>5. Tăng đánh giá google maps phù hợp với:</strong></span></h3>

    <p>Dịch vụ tăng đánh giá 5 sao cho các địa điểm như nhà hàng, quán ăn, khách sạn, Phòng khám, tiệm nail, Spa,  Bệnh viện, Công ty, Trường học, doanh nghiệp, quán bar, khu du lịch..... tất cả những địa điểm có hiển thị review google maps quý khách hàng đều có thể mua đánh giá google cho doanh nghiệp của mình để tạo lợi thế kinh doanh trong thời đại kinh tế thị trường đang dần chuyển qua kinh doanh online.</p>

    <h3><span style="color:#ff0000;"><strong>6. Cách đánh giá 5 sao trên google được hiển thị.</strong></span></h3>

    <p>Có một số yếu tố ảnh hưởng đến cách đánh giá gg map được hiển thị:</p>

    <p><strong>1. Tính hữu ích:</strong> Google Maps sử dụng thuật toán để xác định bài đánh giá nào hữu ích nhất cho người dùng. Các yếu tố được xem xét bao gồm:</p>

    <ul>
        <li>Số lần google maps review được đánh dấu là "hữu ích"</li>
        <li>Số lượng bài đánh giá của người dùng</li>
        <li>Chất lượng bài đánh giá (ví dụ: chi tiết, đầy đủ thông tin, chính xác)</li>
        <li>Mức độ liên quan của bài đánh giá (ví dụ: bài đánh giá có đề cập đến trải nghiệm gần đây hay không)</li>
    </ul>

    <p><strong>2. Mức độ mới:</strong> Google Maps ưu tiên hiển thị các bài đánh giá mới nhất.<br />
    <strong>3. Tính đa dạng:</strong> Google Maps cố gắng hiển thị nhiều bài đánh giá từ nhiều người dùng khác nhau.<br />
    <strong>4. Cài đặt của bạn:</strong> Bạn có thể điều chỉnh cài đặt Google Maps để chỉ hiển thị các bài đánh giá từ bạn bè hoặc những người có cùng sở thích với bạn.</p>

    <h3><span style="color:#ff0000;"><strong>7. Tại sao đánh giá 5 sao trên Google Maps quan trọng?</strong></span></h3>

    <ul>
        <li><strong>Tăng Tính Cạnh Tranh:</strong> Khi người tiêu dùng tìm kiếm dịch vụ, họ thường sẽ lựa chọn các doanh nghiệp có đánh giá cao hơn. sử dụng dịch vụ đánh giá 5 sao google maps giúp doanh nghiệp của bạn nổi bật hơn so với đối thủ cạnh tranh.</li>
        <li><strong>Xây Dựng Niềm Tin:</strong>  Những review google maps tích cực từ khách hàng trước đó là một cách tốt nhất để xây dựng niềm tin với khách hàng tiềm năng. Họ sẽ cảm thấy tự tin hơn khi chọn lựa doanh nghiệp của bạn nếu thấy nhiều người khác đã có trải nghiệm tích cực.</li>
        <li><strong>Tăng Tỉ Lệ Click:</strong> Doanh nghiệp có những review maps tốt thường có tỉ lệ click vào trang web hoặc liên hệ cao hơn từ các kết quả tìm kiếm. Điều này tăng cơ hội tiếp cận và chuyển đổi khách hàng.</li>
    </ul>

    <h3><span style="color:#ff0000;"><strong>8. Dịch vụ tăng đánh giá Google Maps.</strong></span></h3>

    <ul>
        <li><strong>Tối Ưu Hóa Dịch Vụ và Chất Lượng:</strong> Mua đánh giá 5 sao google maps không thể đạt được nếu không có sự cải thiện liên tục trong chất lượng dịch vụ. Đảm bảo rằng mọi khía cạnh của doanh nghiệp của bạn đều đạt được sự hài lòng của khách hàng.</li>
        <li><strong>Kích Thích Phản Hồi Tích Cực:</strong> Hãy tích cực khuyến khích khách hàng hiện tại của bạn để lại đánh giá tích cực bằng cách cung cấp khuyến mãi, ưu đãi hoặc thậm chí chỉ đơn giản là yêu cầu một cách trực tiếp. Đừng ngần ngại hỏi khách hàng của bạn về trải nghiệm của họ và sẵn lòng sửa chữa mọi vấn đề nếu có.</li>
        <li><strong>Phản Hồi Chuyên Nghiệp và Nhanh Chóng:</strong> Phản hồi nhanh chóng và chuyên nghiệp đối với cả phản hồi tích cực và tiêu cực là rất quan trọng. Điều này thể hiện sự tôn trọng và chăm sóc đối với khách hàng, và cũng có thể giải quyet hiệu quả các vấn đề phát sinh.</li>
        <li><strong>Tối Ưu Hóa Trang Thông Tin Doanh Nghiệp:</strong> Đảm bảo thông tin của doanh nghiệp trên Google Maps là chính xác và cập nhật. Hình ảnh, giờ làm việc, địa chỉ và thông tin liên hệ nên được hiển thị một cách rõ ràng và dễ dàng tiếp cận.</li>
        <li><strong>Quảng Cáo và Tiếp Thị:</strong> Sử dụng các chiến lược quảng cáo và tiếp thị để khuyến khích khách hàng đến và gửi lại phản hồi tích cực. Các chiến dịch quảng cáo tăng review maps có thể tạo ra một lượng lớn lượt xem và tương tác, từ đó tăng khả năng nhận được đánh giá tích cực.</li>
    </ul>

    <p><span style="color:#ff0000;"><strong>9. Kết luận</strong></span></p>

    <p><strong><a href="https://danhgiamaps.vn/"><u>Mua đánh giá 5 sao google map</u></a></strong> không chỉ là một cách để tăng sự nhận thức và độ tin cậy của doanh nghiệp của bạn, mà còn là một cơ hội để cải thiện chất lượng dịch vụ và tạo ra mối quan hệ tốt hơn với khách hàng. Bằng cách tuân thủ các chiến lược kỹ lưỡng và nắm vững nguyên tắc cơ bản của dịch vụ đánh giá google map, bạn có thể đưa doanh nghiệp của mình lên tầm cao mới trên mạng lưới kinh doanh số này.</p>

    <p style="text-align:right;"><strong>ADMIN: <a href="https://www.facebook.com/ngo.v.nam">NGÔ VĂN NAM</a></strong></p>

    <p style="text-align:right;"><strong>CALL/ZALO: 0968 533 675</strong></p>

                </div>
            </div>
        </div>
    </div>
@endsection
