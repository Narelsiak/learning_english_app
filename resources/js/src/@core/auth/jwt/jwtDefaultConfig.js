export default {
  // Endpoints
  userDataEndpoint: '/api/auth/user/data/me',
  loginEndpoint: '/api/auth/login',
  registerEndpoint: '/api/auth/register',
  livesEndpoint: '/api/system/daily_user_life',
  // refreshEndpoint: '/jwt/refresh-token',
  logoutEndpoint: '/api/auth/logout',

  // This will be prefixed in authorization header with token
  // e.g. Authorization: Bearer <token>
  tokenType: 'Bearer',

  // Value of this property will be used as key to store JWT token in storage
  // storageRefreshTokenKeyName: 'refreshToken',
}
