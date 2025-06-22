import { NextRequest, NextResponse } from 'next/server'

export function middleware(request: NextRequest) {
  // Basic認証のヘッダーを取得
  const authHeader = request.headers.get('authorization')

  // 環境変数から認証情報を取得
  const username = process.env.BASIC_AUTH_USERNAME
  const password = process.env.BASIC_AUTH_PASSWORD
  
  // 環境変数が設定されていない場合は認証を拒否
  if (!username || !password) {
    console.error('Basic認証の環境変数が設定されていません')
    return new NextResponse('Authentication configuration error', {
      status: 500,
      headers: {
        'Content-Type': 'text/plain',
      },
    })
  }
  
  // 認証情報をBase64エンコード
  const expectedAuth = `Basic ${Buffer.from(`${username}:${password}`).toString('base64')}`

  // 認証ヘッダーが存在しない、または期待される値と一致しない場合
  if (!authHeader || authHeader !== expectedAuth) {
    // 401 Unauthorizedレスポンスを返す
    return new NextResponse('Authentication required', {
      status: 401,
      headers: {
        'WWW-Authenticate': 'Basic realm="Secure Area"',
        'Content-Type': 'text/plain',
      },
    })
  }

  // 認証が成功した場合、次の処理に進む
  return NextResponse.next()
}

// middlewareを適用するパスを設定
export const config = {
  matcher: [
    /*
     * Match all request paths except for the ones starting with:
     * - api (API routes)
     * - _next/static (static files)
     * - _next/image (image optimization files)
     * - favicon.ico (favicon file)
     * - public folder
     */
    '/((?!api|_next/static|_next/image|favicon.ico|public).*)',
  ],
} 
