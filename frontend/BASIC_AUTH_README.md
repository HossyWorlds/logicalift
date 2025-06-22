# Basic認証の実装

このプロジェクトでは、Next.js middlewareを使用してBasic認証を実装しています。

## ファイル構成

- `src/middleware.ts` - Basic認証middleware

## セットアップ

### 1. 環境変数の設定（必須）

プロジェクトルートに`.env.local`ファイルを作成し、以下の内容を設定してください：

```bash
# Basic認証の設定（必須）
BASIC_AUTH_USERNAME=your_username
BASIC_AUTH_PASSWORD=your_secure_password
```

**重要**: 環境変数が設定されていない場合、アプリケーションは500エラーを返します。

### 2. 認証情報の設定

**重要**: 本番環境では必ず強力なパスワードに変更してください。

## 使用方法

### 開発サーバーの起動

```bash
npm run dev
```

### アクセス時の認証

ブラウザでアプリケーションにアクセスすると、Basic認証のダイアログが表示されます。
設定したユーザー名とパスワードを入力してください。

## 設定オプション

### 認証をスキップするパス

`src/middleware.ts`の`config.matcher`で、認証を適用しないパスを設定できます：

```typescript
export const config = {
  matcher: [
    '/((?!api|_next/static|_next/image|favicon.ico|public).*)',
  ],
}
```

## セキュリティに関する注意事項

1. **HTTPSの使用**: Basic認証は平文でパスワードを送信するため、本番環境では必ずHTTPSを使用してください。

2. **強力なパスワード**: 本番環境では強力なパスワードを設定してください。

3. **環境変数の管理**: 認証情報は環境変数で管理し、ソースコードに直接記述しないでください。

4. **定期的な更新**: セキュリティのため、定期的にパスワードを更新してください。

## トラブルシューティング

### 認証が効かない場合

1. 環境変数が正しく設定されているか確認
2. `.env.local`ファイルがプロジェクトルートにあるか確認
3. 開発サーバーを再起動

### 500エラーが発生する場合

環境変数`BASIC_AUTH_USERNAME`と`BASIC_AUTH_PASSWORD`が設定されているか確認してください。

### 特定のパスで認証をスキップしたい場合

`src/middleware.ts`の`config.matcher`を編集して、必要なパスを除外してください。
