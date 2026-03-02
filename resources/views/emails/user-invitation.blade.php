<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f1f5f9; padding: 40px 0;">
    <tr>
      <td align="center">
        <table width="560" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
          {{-- Header --}}
          <tr>
            <td style="background: linear-gradient(135deg, #E8772A 0%, #c25e15 100%); padding: 32px 40px; text-align: center;">
              <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="DGIE" width="60" style="margin-bottom: 12px;">
              <h1 style="color: #ffffff; font-size: 20px; font-weight: 700; margin: 0;">Bienvenue sur la plateforme DGIE</h1>
            </td>
          </tr>

          {{-- Body --}}
          <tr>
            <td style="padding: 36px 40px;">
              <p style="font-size: 15px; color: #334155; line-height: 1.6; margin: 0 0 20px;">
                Bonjour <strong>{{ $user->name }}</strong>,
              </p>
              <p style="font-size: 15px; color: #334155; line-height: 1.6; margin: 0 0 20px;">
                Vous avez été invité(e) à rejoindre la plateforme d'administration de la <strong>Direction Générale des Ivoiriens de l'Extérieur</strong> en tant que <strong>{{ $user->getRoleLabel() }}</strong>.
              </p>

              {{-- Credentials box --}}
              <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; margin: 24px 0;">
                <tr>
                  <td style="padding: 20px 24px;">
                    <p style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; font-weight: 600; margin: 0 0 12px;">Vos identifiants de connexion</p>
                    <table cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="font-size: 14px; color: #64748b; padding: 4px 0; width: 120px;">Email :</td>
                        <td style="font-size: 14px; color: #1e293b; font-weight: 600; padding: 4px 0;">{{ $user->email }}</td>
                      </tr>
                      <tr>
                        <td style="font-size: 14px; color: #64748b; padding: 4px 0;">Mot de passe :</td>
                        <td style="font-size: 14px; color: #1e293b; font-weight: 600; padding: 4px 0; font-family: monospace; letter-spacing: 0.5px;">{{ $password }}</td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              {{-- Warning --}}
              <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fef3c7; border-left: 4px solid #f59e0b; border-radius: 4px; margin: 20px 0;">
                <tr>
                  <td style="padding: 14px 16px;">
                    <p style="font-size: 13px; color: #92400e; margin: 0; line-height: 1.5;">
                      <strong>Important :</strong> Pour des raisons de sécurité, vous serez invité(e) à modifier votre mot de passe lors de votre première connexion.
                    </p>
                  </td>
                </tr>
              </table>

              {{-- CTA Button --}}
              <table width="100%" cellpadding="0" cellspacing="0" style="margin: 28px 0;">
                <tr>
                  <td align="center">
                    <a href="{{ url('/admin/login') }}" style="display: inline-block; background: #E8772A; color: #ffffff; text-decoration: none; padding: 14px 36px; border-radius: 8px; font-size: 15px; font-weight: 600;">
                      Se connecter
                    </a>
                  </td>
                </tr>
              </table>

              <p style="font-size: 14px; color: #64748b; line-height: 1.6; margin: 0;">
                Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer cet email.
              </p>
            </td>
          </tr>

          {{-- Footer --}}
          <tr>
            <td style="background-color: #f8fafc; padding: 20px 40px; border-top: 1px solid #e2e8f0; text-align: center;">
              <p style="font-size: 12px; color: #94a3b8; margin: 0;">
                DGIE — Direction Générale des Ivoiriens de l'Extérieur<br>
                Ministère des Affaires Étrangères — République de Côte d'Ivoire
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
