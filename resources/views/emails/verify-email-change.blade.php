<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f0f2f5; font-family: -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f0f2f5; padding: 48px 16px;">
    <tr>
      <td align="center">

        {{-- Logo --}}
        <table width="520" cellpadding="0" cellspacing="0" style="margin-bottom: 24px;">
          <tr>
            <td align="center">
              <table cellpadding="0" cellspacing="0" style="background: #1e293b; border-radius: 14px; padding: 14px 24px;">
                <tr>
                  <td style="vertical-align: middle; padding-right: 12px;">
                    <img src="{{ asset('assets/images/logo-dgie.png') }}" alt="DGIE" width="36" height="36" style="display: block;">
                  </td>
                  <td style="vertical-align: middle;">
                    <span style="font-size: 16px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px;">DGIE</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>

        {{-- Main card --}}
        <table width="520" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.04);">

          {{-- Icon + Greeting --}}
          <tr>
            <td style="padding: 40px 40px 0;">
              <table cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
                <tr>
                  <td style="background: #eff6ff; border-radius: 12px; width: 48px; height: 48px; text-align: center; vertical-align: middle;">
                    <span style="font-size: 22px;">&#9993;</span>
                  </td>
                </tr>
              </table>
              <p style="font-size: 14px; color: #94a3b8; margin: 0 0 6px; font-weight: 500;">Changement d'adresse</p>
              <h1 style="font-size: 22px; font-weight: 700; color: #1e293b; margin: 0 0 20px; line-height: 1.3;">Confirmez votre nouvel email</h1>
              <p style="font-size: 15px; color: #475569; line-height: 1.65; margin: 0;">
                Bonjour <strong>{{ $user->name }}</strong>, vous avez demandé à changer votre adresse email sur la plateforme DGIE.
              </p>
            </td>
          </tr>

          {{-- Divider --}}
          <tr>
            <td style="padding: 28px 40px 0;">
              <div style="border-top: 1px solid #e2e8f0;"></div>
            </td>
          </tr>

          {{-- Info card --}}
          <tr>
            <td style="padding: 28px 40px 0;">
              <p style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; font-weight: 700; margin: 0 0 16px;">Nouvelle adresse email</p>
              <table width="100%" cellpadding="0" cellspacing="0" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                <tr>
                  <td style="padding: 20px 24px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="padding: 6px 0;">
                          <span style="font-size: 12px; color: #94a3b8; font-weight: 500;">Adresse actuelle</span><br>
                          <span style="font-size: 15px; color: #64748b; font-weight: 500;">{{ $user->email }}</span>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 14px 0 6px; border-top: 1px dashed #e2e8f0;">
                          <span style="font-size: 12px; color: #94a3b8; font-weight: 500;">Nouvelle adresse</span><br>
                          <span style="font-size: 16px; color: #1e293b; font-weight: 700;">{{ $user->pending_email }}</span>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          {{-- Warning --}}
          <tr>
            <td style="padding: 20px 40px 0;">
              <table width="100%" cellpadding="0" cellspacing="0" style="background: #fef3c7; border-radius: 10px;">
                <tr>
                  <td style="padding: 14px 18px; vertical-align: top; width: 24px;">
                    <span style="font-size: 16px;">&#9200;</span>
                  </td>
                  <td style="padding: 14px 18px 14px 0;">
                    <p style="font-size: 13px; color: #92400e; margin: 0; line-height: 1.5;">
                      Ce lien expire dans <strong>24 heures</strong>. Si vous n'avez pas fait cette demande, ignorez simplement cet email.
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          {{-- CTA Button --}}
          <tr>
            <td style="padding: 32px 40px;" align="center">
              <a href="{{ $verificationUrl }}" style="display: inline-block; background: #E8772A; color: #ffffff; text-decoration: none; padding: 14px 48px; border-radius: 10px; font-size: 15px; font-weight: 600; box-shadow: 0 2px 8px rgba(232, 119, 42, 0.25);">
                Confirmer cette adresse email
              </a>
            </td>
          </tr>
        </table>

        {{-- Footer --}}
        <table width="520" cellpadding="0" cellspacing="0" style="margin-top: 28px;">
          <tr>
            <td align="center">
              <p style="font-size: 12px; color: #94a3b8; margin: 0 0 6px;">
                Si vous n'avez pas demandé ce changement, vous pouvez ignorer cet email en toute securite.
              </p>
              <p style="font-size: 12px; color: #94a3b8; margin: 0 0 4px;">
                DGIE — Direction Generale des Ivoiriens de l'Exterieur
              </p>
              <p style="font-size: 11px; color: #cbd5e1; margin: 0;">
                Ministere des Affaires Etrangeres — Republique de Cote d'Ivoire
              </p>
            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>
</body>
</html>
