<?php
	//thu nhat neu co nhieu pha xu ly back end thi nen lam gi do ???
	//dau tien thuc hien cac van de theo kieu nhu la???
	//vi du trong code do thi no se ton tai ngay khu vuc socket dung la nhu vay ??/
		
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/styles/default.min.css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.1.2/highlight.min.js"></script>
	<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
	
	<div id="banner-top">
		<img src="http://sachtoan24h.com/wp-content/uploads/2018/11/banner.png" width="1000px" height="180px" />
	</div>

	<div id="menu-top">
		<ul>
			<li class="main-title"><a href="index1.php" >Trang chủ</a></li>
			<li class="main-title"><a href="#" >Giới thiệu</a></li>
			<li class="main-title">
				<div class="drop-out">
				<a href="documents.php">
					<div>Tài liệu</div>
					<div class="drop-out-content" style="width: 500px; ">
							<ul>
								<li class="sub-title"><a href="#">Toán học</a></li>
								<li class="sub-title"><a href="#">Lập trình</a></li>
								<li class="sub-title"><a href="#">Thuật toán</a></li>
								<li class="sub-title"><a href="#">Machine Learning</a></li>
							</ul>
						
					</div>
				</a>
				</div>
			</li>
			<li class="main-title"><a href="#">Liên hệ</a></li>
			<li class="main-title"><a href="#">Forum</a></li>
			<li class="main-title">
				<div class="drop-out">
					<a href="#">
						<div>Cá nhân</div>
						<div class="drop-out-content"  style="width: 410px;">
							<ul>
								<li class="sub-title"><a href="#">Thông tin cá nhân</a></li>
								<li class="sub-title"><a href="#">Quản lý đơn hàng</a></li>	
								<li class="sub-title"><a href="#">Mã giảm giá</a></li>
								<li class="sub-title"><a href="#">Sản phẩm đã xem</a></li>
							</ul>
						</div>
					</a>
				</div>	
			</li>
		</ul>
	</div>
	<div id="main">
		<div></div>
		<div id="left">
			<h2 style="margin-top: 10px;">Sách thuật toán kinh điển</h2>
			<pre><code class="language-cpp">#include <span><</span>iostream>
#include <span><</span>algorithm>
#include <span><</span>vector>
#include <span><</span>bitset>
using namespace std;
typedef vector<span><</span>int> vi;
typedef pair<span><</span>int, int> ii;
typedef vector<span><</span>ii> vii;
typedef long long ll;
bitset<10000010> bs;
vi primes;

int phi[1000001];
int unt[1000001];
ll F[1000001];
void sieve(ll up) {
	bs.set();
	bs[0] = bs[1] = 0;
	for (ll i = 2; i <= up; i++) {
		if (bs[i]) {
			for(ll j=i*i;j<=up;j+=i){
				bs[j] = 0;
				unt[j] = i;

			}
			primes.push_back(i);
		}
	}
}
void cal() {
	F[1] = 0;
	F[2] = 1;
	for (int i = 3; i <= 1000000; i++) {
		F[i] = F[i - 1] + phi[i];
	}
}
ll tinh(int n) {
	int x = n / 2;
	ll ans= 0;
	for (int i = 1; i <= x; i++) {
		int val = n / i;
		ans += F[val]*i;
	}
	return ans;
}
void solve() {
	phi[1] = 1;
	phi[2] = 1;
	phi[3] = 2;

	for (int i = 4; i <= 1000000; i++) {
		int x = i,s=1;

		if (bs[x]) {
			phi[x] = x - 1;
			continue;
		}
		
		int v = unt[i];
		x /= v;
		while (x%v == 0) {
			x /= v;
			s *= v;
		}
		phi[i] = s* phi[x]*(v-1);
	}
	cal();
}

int main()
{
	sieve(1000001);
	
	solve();
	int n;
	while (cin >> n) {
		if (n == 0) break;
		cout << tinh(n) << endl;
	}
	
	system("pause");
	return 0;
}
</code></pre>
		</div>
		<div id="right" style=" min-height: 200px;">
			<div style="background-color: black;">
			<h3>Danh mục sản phẩm</h3>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Sách kinh điển</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Cấu trúc dữ liệu</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Thuật toán căn bản</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Thuật toán trong CP</div>
					<div class="drop-out-content">
						<ul>
							<li><a href="#">Đại số</a></li>
							<li><a href="#">Hình học</a></li>
							<li><a href="#">Số học</a></li>
							<li><a href="#">Tổ hợp</a></li>
						</ul>
					</div>
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Các kỹ thuật nâng cao</div>
					
				</a>
			</div>
			<div class="drop-out" style="border-bottom: 1px solid white;">
				<a href="#" style="text-decoration: none;">
					<div id="catego">Lời giải một số bài tập SPOJ</div>
					
				</a>
			</div>
			</div>
		</div>
	</div>
	<div id="footer"></div>
</body>
</html>