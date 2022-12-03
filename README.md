# BBテニス 試合エントリー管理システム
## 現状
- 試合にエントリーしたい一般ユーザーは、その旨を記載したメールを送信してエントリーする。管理者はメール受信後、試合にエントリーできるか、キャンセル待ちかをエントリーした一般ユーザーに返信する。 

## ホームページ
http://mattan.jp/bb/

## 問題点
【一般ユーザー】
- メールで試合にエントリーするので、エントリー完了かキャンセル待ちかすぐにはわからない。
- メールでエントリーする際に、メール本文を考えるのが手間。
- ダブルスで、以前に組んで出場したペアの情報（フルネーム・住所等）を過去のメール履歴から遡って確認しなければいけない。

【管理者】
- 試合のエントリーをメールで受けているので、返信する手間が生じる。
- メールでは各試合のエントリー状況を管理しづらいので、エクセル等他のツールで管理する必要が生じる。さらにエントリー者の情報を転記する必要が生じる。
- 試合前日の連絡など、複数のエントリー者にメールを送信するのが手間。
- ホームページには試合情報を記載した画像を作成して貼り付けている為、都度ホームページを更新する必要がある。 
- キャンペーンを打ち出す際、一般ユーザーの情報を収集・管理できていないので分析しづらい（例えば、どのユーザーが最近よく試合に出ているか、等）

## システムを導入することのメリット
【一般ユーザー】
- 試合にエントリー可能かキャンセル待ちかすぐにわかる。
- 画面上の操作だけで簡単に試合にエントリーできる。
- ペア情報を保存しておけるので、タブルスのペアの情報を過去のメール等の履歴から遡って確認する必要がなくなる。

【管理者】
- メールでの対応がほとんどなくなる。
- エントリー管理画面で各大会のエントリー状況を管理できるようになり、エントリーされた情報をメールから転記する必要がなくなる。
- 試合の日時や種目等で絞り込み、条件に合致した複数のユーザーに対しメールを簡単に送信できる。
- ホームページを更新する必要がなくなる。
- 一般ユーザーの情報を蓄積できるので、最近の傾向やよく出場しているユーザーの把握等分析ができる。

## システムで必要な制御
- 一般ユーザーが性別的な問題でエントリー不可な試合にエントリーしていないか（例えば、男性は女子ダブルスにエントリーができてはいけない）
- 同一日付・種目に同一人物がエントリーしていないか
- 各試合で設定されたエントリー可能人数を超えてエントリーしていないか

## 開発スケジュール
### STEP1：基本機能の実装
【フロント側】
- 画面上で試合にエントリーできる
- 会員登録・ログイン機能
- エントリーした試合情報をログイン後画面で確認できる
- プロフィール及びお気に入りダブルスペア情報の編集機能

【管理者側】
- エントリー情報の管理
- 大会及び種目・場所情報の登録
- 管理者情報の管理

### STEP2：LINE連携
【フロント側】
- LINEアカウント経由でログインできる
- 試合エントリー完了後及び試合前日に案内をLINEへ通知

【管理者側】
- 管理画面から一般ユーザーへの案内をLINEで通知（雨天による試合キャンセル連絡等）

## あれば良いと思う機能
- お気に入りダブルスペア登録機能（同じペアと何度も試合に出る可能性がある為）
- LINEによる試合情報の通知機能
- 大会情報新規登録時、最大エントリー人数・エントリー費・大会開始時間自動設定機能（シングルス・ダブルス等の種目毎で大体決まっている為）
- エントリー管理画面で絞り込んだ該当エントリー者に一斉通知する機能
