import nodemailer from 'nodemailer'

// Sanitise user input before injecting into HTML emails
function esc(str) {
  if (!str) return ''
  return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;')
}

// SMTP transporter using Google Workspace
const transporter = nodemailer.createTransport({
  host: 'smtp.gmail.com',
  port: 587,
  secure: false,
  auth: {
    user: process.env.SMTP_USER,
    pass: process.env.SMTP_PASS,
  },
})

// Email templates
const templates = {
  // New lead from website form
  newLead: (data) => ({
    subject: `New Lead: ${esc(data.first_name)} ${esc(data.last_name)} — ${esc(data.source) || 'Website'}`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 24px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 24px;">
          <h2 style="color: #1a1a1a; font-size: 18px; margin-top: 0;">New Lead Captured</h2>
          <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr>
              <td style="padding: 8px 0; color: #666; width: 140px;">Name</td>
              <td style="padding: 8px 0; color: #1a1a1a; font-weight: 500;">${esc(data.first_name)} ${esc(data.last_name)}</td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Email</td>
              <td style="padding: 8px 0; color: #1a1a1a;"><a href="mailto:${esc(data.email)}" style="color: #4a90d9;">${esc(data.email)}</a></td>
            </tr>
            ${data.phone ? `<tr>
              <td style="padding: 8px 0; color: #666;">Phone</td>
              <td style="padding: 8px 0; color: #1a1a1a;"><a href="tel:${esc(data.phone)}" style="color: #4a90d9;">${esc(data.phone)}</a></td>
            </tr>` : ''}
            <tr>
              <td style="padding: 8px 0; color: #666;">Source</td>
              <td style="padding: 8px 0; color: #1a1a1a;">${esc(data.source) || 'Website'}</td>
            </tr>
            ${data.page_url ? `<tr>
              <td style="padding: 8px 0; color: #666;">Page</td>
              <td style="padding: 8px 0; color: #1a1a1a;"><a href="${data.page_url}" style="color: #4a90d9;">${data.page_url}</a></td>
            </tr>` : ''}
            ${data.utm_campaign ? `<tr>
              <td style="padding: 8px 0; color: #666;">Campaign</td>
              <td style="padding: 8px 0; color: #1a1a1a;">${data.utm_source || ''} / ${data.utm_medium || ''} / ${data.utm_campaign}</td>
            </tr>` : ''}
          </table>
          ${data.questionnaire_data ? `
            <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e5e3df;">
              <h3 style="color: #1a1a1a; font-size: 14px; margin-top: 0;">Questionnaire Answers</h3>
              <pre style="background: #faf9f7; padding: 12px; border-radius: 8px; font-size: 12px; overflow-x: auto; white-space: pre-wrap;">${JSON.stringify(data.questionnaire_data, null, 2)}</pre>
            </div>
          ` : ''}
        </div>
        <p style="text-align: center; color: #999; font-size: 12px; margin-top: 16px;">
          This is an automated notification from the Don't Weight system.
        </p>
      </div>
    `,
  }),

  // New user signup / account created
  newSignup: (data) => ({
    subject: `New Patient Signup: ${esc(data.first_name)} ${esc(data.last_name)} (${esc(data.email)})`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 24px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 24px;">
          <h2 style="color: #1a1a1a; font-size: 18px; margin-top: 0;">New Patient Account Created</h2>
          <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr>
              <td style="padding: 8px 0; color: #666; width: 140px;">Name</td>
              <td style="padding: 8px 0; color: #1a1a1a; font-weight: 500;">${esc(data.first_name)} ${esc(data.last_name)}</td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Email</td>
              <td style="padding: 8px 0; color: #1a1a1a;"><a href="mailto:${esc(data.email)}" style="color: #4a90d9;">${esc(data.email)}</a></td>
            </tr>
          </table>
          <div style="margin-top: 16px; padding: 12px; background: #e8f4e8; border-radius: 8px; font-size: 13px; color: #2d6a2d;">
            A portal account has been created and a welcome/password-reset email has been sent to the patient.
          </div>
        </div>
        <p style="text-align: center; color: #999; font-size: 12px; margin-top: 16px;">
          This is an automated notification from the Don't Weight system.
        </p>
      </div>
    `,
  }),

  // New subscription / order
  newSubscription: (data) => ({
    subject: `New Subscription: ${esc(data.email)} — ${esc(data.treatment)} ${esc(data.dose)}`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 24px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 24px;">
          <h2 style="color: #1a1a1a; font-size: 18px; margin-top: 0;">New Subscription Created</h2>
          <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr>
              <td style="padding: 8px 0; color: #666; width: 140px;">Patient</td>
              <td style="padding: 8px 0; color: #1a1a1a; font-weight: 500;">${esc(data.name) || esc(data.email)}</td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Email</td>
              <td style="padding: 8px 0; color: #1a1a1a;"><a href="mailto:${esc(data.email)}" style="color: #4a90d9;">${esc(data.email)}</a></td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Treatment</td>
              <td style="padding: 8px 0; color: #1a1a1a; font-weight: 500;">${esc(data.treatment) || 'N/A'}</td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Dose</td>
              <td style="padding: 8px 0; color: #1a1a1a;">${esc(data.dose) || 'N/A'}</td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Monthly Price</td>
              <td style="padding: 8px 0; color: #1a1a1a; font-weight: 500;">&pound;${(data.price_monthly / 100).toFixed(2)}</td>
            </tr>
          </table>
        </div>
        <p style="text-align: center; color: #999; font-size: 12px; margin-top: 16px;">
          This is an automated notification from the Don't Weight system.
        </p>
      </div>
    `,
  }),

  // Contact form submission
  contactForm: (data) => ({
    subject: `Contact Form: ${esc(data.subject)} - from ${esc(data.first_name)} ${esc(data.last_name)}`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 24px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 24px;">
          <h2 style="color: #1a1a1a; font-size: 18px; margin-top: 0;">New Contact Form Submission</h2>
          <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr>
              <td style="padding: 8px 0; color: #666; width: 140px;">Name</td>
              <td style="padding: 8px 0; color: #1a1a1a; font-weight: 500;">${esc(data.first_name)} ${esc(data.last_name)}</td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Email</td>
              <td style="padding: 8px 0; color: #1a1a1a;"><a href="mailto:${esc(data.email)}" style="color: #4a90d9;">${esc(data.email)}</a></td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Subject</td>
              <td style="padding: 8px 0; color: #1a1a1a;">${esc(data.subject)}</td>
            </tr>
          </table>
          <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e5e3df;">
            <h3 style="color: #1a1a1a; font-size: 14px; margin-top: 0;">Message</h3>
            <p style="color: #333; font-size: 14px; line-height: 1.6; white-space: pre-wrap;">${esc(data.message)}</p>
          </div>
        </div>
        <p style="text-align: center; color: #999; font-size: 12px; margin-top: 16px;">
          This is an automated notification from the Don't Weight system.
        </p>
      </div>
    `,
  }),

  // Consultation form submission
  consultationSubmission: (data) => ({
    subject: `New Consultation: ${esc(data.first_name)} ${esc(data.last_name)} — ${esc(data.treatment) || 'Treatment TBD'}`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 24px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 24px;">
          <h2 style="color: #1a1a1a; font-size: 18px; margin-top: 0;">New Consultation Submission</h2>
          <div style="margin-bottom: 16px; padding: 12px; background: #fff3cd; border-radius: 8px; font-size: 13px; color: #856404;">
            This consultation requires clinical review before treatment can proceed.
          </div>
          <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <tr>
              <td style="padding: 8px 0; color: #666; width: 140px;">Name</td>
              <td style="padding: 8px 0; color: #1a1a1a; font-weight: 500;">${esc(data.first_name)} ${esc(data.last_name)}</td>
            </tr>
            <tr>
              <td style="padding: 8px 0; color: #666;">Email</td>
              <td style="padding: 8px 0; color: #1a1a1a;"><a href="mailto:${esc(data.email)}" style="color: #4a90d9;">${esc(data.email)}</a></td>
            </tr>
            ${data.phone ? `<tr>
              <td style="padding: 8px 0; color: #666;">Phone</td>
              <td style="padding: 8px 0; color: #1a1a1a;">${esc(data.phone)}</td>
            </tr>` : ''}
            ${data.date_of_birth ? `<tr>
              <td style="padding: 8px 0; color: #666;">DOB</td>
              <td style="padding: 8px 0; color: #1a1a1a;">${esc(data.date_of_birth)}</td>
            </tr>` : ''}
            ${data.treatment ? `<tr>
              <td style="padding: 8px 0; color: #666;">Treatment</td>
              <td style="padding: 8px 0; color: #1a1a1a; font-weight: 500;">${esc(data.treatment)}</td>
            </tr>` : ''}
          </table>
          ${data.questionnaire_data ? `
            <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #e5e3df;">
              <h3 style="color: #1a1a1a; font-size: 14px; margin-top: 0;">Medical Questionnaire</h3>
              <pre style="background: #faf9f7; padding: 12px; border-radius: 8px; font-size: 12px; overflow-x: auto; white-space: pre-wrap;">${JSON.stringify(data.questionnaire_data, null, 2)}</pre>
            </div>
          ` : ''}
        </div>
        <p style="text-align: center; color: #999; font-size: 12px; margin-top: 16px;">
          This is an automated notification from the Don't Weight system.
        </p>
      </div>
    `,
  }),

  // Welcome email sent TO the patient (not admin)
  welcomePatient: (data) => ({
    to: data.email,
    subject: `Welcome to don't weight, ${esc(data.first_name)}! 🎉`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 28px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
          <p style="color: #666; font-size: 13px; margin-top: 4px;">Stop waiting. Start losing.</p>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 32px;">
          <h2 style="color: #1a1a1a; font-size: 20px; margin-top: 0;">Welcome, ${esc(data.first_name)}!</h2>
          <p style="color: #444; font-size: 14px; line-height: 1.6;">
            Thank you for joining don't weight. You've taken an incredible first step towards a healthier, happier you.
          </p>
          <p style="color: #444; font-size: 14px; line-height: 1.6;">
            Here's what to do next:
          </p>
          <div style="margin: 20px 0;">
            <div style="display: flex; align-items: flex-start; margin-bottom: 16px;">
              <div style="width: 28px; height: 28px; border-radius: 50%; background: #38BDF8; color: white; font-size: 13px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">1</div>
              <div>
                <p style="margin: 0; font-weight: 600; color: #1a1a1a; font-size: 14px;">Book your video consultation</p>
                <p style="margin: 4px 0 0; color: #666; font-size: 13px;">Speak with a clinician to find the right treatment for you.</p>
              </div>
            </div>
            <div style="display: flex; align-items: flex-start; margin-bottom: 16px;">
              <div style="width: 28px; height: 28px; border-radius: 50%; background: #38BDF8; color: white; font-size: 13px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">2</div>
              <div>
                <p style="margin: 0; font-weight: 600; color: #1a1a1a; font-size: 14px;">Log your starting weight</p>
                <p style="margin: 4px 0 0; color: #666; font-size: 13px;">Track your progress from day one in your patient portal.</p>
              </div>
            </div>
            <div style="display: flex; align-items: flex-start;">
              <div style="width: 28px; height: 28px; border-radius: 50%; background: #38BDF8; color: white; font-size: 13px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">3</div>
              <div>
                <p style="margin: 0; font-weight: 600; color: #1a1a1a; font-size: 14px;">Message your clinician</p>
                <p style="margin: 4px 0 0; color: #666; font-size: 13px;">Ask questions, share concerns, get support anytime.</p>
              </div>
            </div>
          </div>
          <div style="text-align: center; margin-top: 24px;">
            <a href="https://app.dontweight.co.uk" style="display: inline-block; background: #38BDF8; color: white; padding: 14px 32px; border-radius: 50px; font-size: 14px; font-weight: 600; text-decoration: none;">Go to Your Patient Portal</a>
          </div>
          <div style="margin-top: 24px; padding: 16px; background: #f0fdf4; border-radius: 12px; text-align: center;">
            <p style="margin: 0; color: #166534; font-size: 13px; font-weight: 600;">100% money-back guarantee</p>
            <p style="margin: 4px 0 0; color: #166534; font-size: 12px;">Not satisfied within 14 days? Full refund, no questions asked.</p>
          </div>
        </div>
        <div style="text-align: center; margin-top: 20px; color: #999; font-size: 12px;">
          <p style="margin: 0;">Need help? Email <a href="mailto:hello@dontweight.co.uk" style="color: #4a90d9;">hello@dontweight.co.uk</a></p>
          <p style="margin: 8px 0 0;">CQC Registered · MHRA Approved · ICO Compliant</p>
        </div>
      </div>
    `,
  }),

  // Order in clinical review — sent TO patient
  orderInReview: (data) => ({
    to: data.email,
    subject: `We've received your order, ${esc(data.first_name)}`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 28px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 32px;">
          <div style="text-align: center; margin-bottom: 20px;">
            <div style="width: 48px; height: 48px; background: #eff6ff; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 24px;">🔍</div>
          </div>
          <h2 style="color: #1a1a1a; font-size: 20px; margin-top: 0; text-align: center;">Your Order Is Being Reviewed</h2>
          <p style="color: #444; font-size: 14px; line-height: 1.6; text-align: center;">
            Hi ${esc(data.first_name)}, your order for <strong>${esc(data.treatment)} ${esc(data.dose)}</strong> has been received and is now being reviewed by our clinical team.
          </p>
          <div style="background: #eff6ff; border-radius: 12px; padding: 16px; margin: 20px 0; text-align: center;">
            <p style="margin: 0; color: #1e40af; font-size: 13px; font-weight: 600;">What happens next?</p>
            <p style="margin: 8px 0 0; color: #1e40af; font-size: 13px;">A UK-registered clinician will review your medical information. You'll receive an email once approved. This usually takes less than 24 hours.</p>
          </div>
          <div style="text-align: center; margin-top: 24px;">
            <a href="https://app.dontweight.co.uk" style="display: inline-block; background: #38BDF8; color: white; padding: 14px 32px; border-radius: 50px; font-size: 14px; font-weight: 600; text-decoration: none;">View Order Status</a>
          </div>
        </div>
        <div style="text-align: center; margin-top: 20px; color: #999; font-size: 12px;">
          <p style="margin: 0;">Questions? Email <a href="mailto:hello@dontweight.co.uk" style="color: #4a90d9;">hello@dontweight.co.uk</a></p>
        </div>
      </div>
    `,
  }),

  // Clinician approved — sent TO patient
  orderApproved: (data) => ({
    to: data.email,
    subject: `Great news — your treatment has been approved! ✅`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 28px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 32px;">
          <div style="text-align: center; margin-bottom: 20px;">
            <div style="width: 48px; height: 48px; background: #f0fdf4; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 24px;">✅</div>
          </div>
          <h2 style="color: #1a1a1a; font-size: 20px; margin-top: 0; text-align: center;">Treatment Approved</h2>
          <p style="color: #444; font-size: 14px; line-height: 1.6; text-align: center;">
            Hi ${esc(data.first_name)}, your clinician has reviewed and approved your prescription for <strong>${esc(data.treatment)} ${esc(data.dose)}</strong>.
          </p>
          <div style="background: #f0fdf4; border-radius: 12px; padding: 16px; margin: 20px 0; text-align: center;">
            <p style="margin: 0; color: #166534; font-size: 13px; font-weight: 600;">Your medication is being prepared</p>
            <p style="margin: 8px 0 0; color: #166534; font-size: 13px;">It will be sent to our pharmacy partner for dispensing. You'll get a tracking number once dispatched.</p>
          </div>
          <div style="text-align: center; margin-top: 24px;">
            <a href="https://app.dontweight.co.uk" style="display: inline-block; background: #38BDF8; color: white; padding: 14px 32px; border-radius: 50px; font-size: 14px; font-weight: 600; text-decoration: none;">Track Your Order</a>
          </div>
        </div>
        <div style="text-align: center; margin-top: 20px; color: #999; font-size: 12px;">
          <p style="margin: 0;">Questions? Email <a href="mailto:hello@dontweight.co.uk" style="color: #4a90d9;">hello@dontweight.co.uk</a></p>
        </div>
      </div>
    `,
  }),

  // Dispatched with tracking — sent TO patient
  orderDispatched: (data) => ({
    to: data.email,
    subject: `Your medication has been dispatched! 📦`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 28px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 32px;">
          <div style="text-align: center; margin-bottom: 20px;">
            <div style="width: 48px; height: 48px; background: #fef3c7; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 24px;">📦</div>
          </div>
          <h2 style="color: #1a1a1a; font-size: 20px; margin-top: 0; text-align: center;">Your Medication Is On Its Way!</h2>
          <p style="color: #444; font-size: 14px; line-height: 1.6; text-align: center;">
            Hi ${esc(data.first_name)}, your <strong>${esc(data.treatment)} ${esc(data.dose)}</strong> has been dispatched and is on its way to you.
          </p>
          ${data.tracking_number ? `
          <div style="background: #faf9f7; border-radius: 12px; padding: 20px; margin: 20px 0;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
              <tr>
                <td style="padding: 6px 0; color: #666;">Carrier</td>
                <td style="padding: 6px 0; color: #1a1a1a; font-weight: 600; text-align: right;">${esc(data.carrier || 'Royal Mail')}</td>
              </tr>
              <tr>
                <td style="padding: 6px 0; color: #666;">Tracking number</td>
                <td style="padding: 6px 0; color: #1a1a1a; font-weight: 600; text-align: right;">${esc(data.tracking_number)}</td>
              </tr>
            </table>
            <div style="text-align: center; margin-top: 16px;">
              <a href="https://www.royalmail.com/track-your-item#/tracking-results/${encodeURIComponent(data.tracking_number)}" style="display: inline-block; background: #dc2626; color: white; padding: 10px 24px; border-radius: 50px; font-size: 13px; font-weight: 600; text-decoration: none;">Track with Royal Mail</a>
            </div>
          </div>` : ''}
          <p style="color: #666; font-size: 13px; line-height: 1.6; text-align: center;">
            Your medication will arrive in discreet packaging, usually within 1-2 working days.
          </p>
          <div style="text-align: center; margin-top: 20px;">
            <a href="https://app.dontweight.co.uk" style="display: inline-block; background: #38BDF8; color: white; padding: 14px 32px; border-radius: 50px; font-size: 14px; font-weight: 600; text-decoration: none;">View in Portal</a>
          </div>
        </div>
        <div style="text-align: center; margin-top: 20px; color: #999; font-size: 12px;">
          <p style="margin: 0;">Questions? Email <a href="mailto:hello@dontweight.co.uk" style="color: #4a90d9;">hello@dontweight.co.uk</a></p>
        </div>
      </div>
    `,
  }),

  // Delivered confirmation — sent TO patient
  orderDelivered: (data) => ({
    to: data.email,
    subject: `Your medication has been delivered ✅`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 28px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 32px;">
          <div style="text-align: center; margin-bottom: 20px;">
            <div style="width: 48px; height: 48px; background: #f0fdf4; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 24px;">🎉</div>
          </div>
          <h2 style="color: #1a1a1a; font-size: 20px; margin-top: 0; text-align: center;">Medication Delivered</h2>
          <p style="color: #444; font-size: 14px; line-height: 1.6; text-align: center;">
            Hi ${esc(data.first_name)}, your <strong>${esc(data.treatment)} ${esc(data.dose)}</strong> has been delivered. You're all set to begin!
          </p>
          <div style="background: #f0fdf4; border-radius: 12px; padding: 16px; margin: 20px 0;">
            <p style="margin: 0; color: #166534; font-size: 14px; font-weight: 600; text-align: center;">Quick reminders:</p>
            <ul style="margin: 12px 0 0; padding-left: 20px; color: #166534; font-size: 13px; line-height: 1.8;">
              <li>Store your medication in the fridge (2-8°C)</li>
              <li>Take your injection on the same day each week</li>
              <li>Log your weight in the portal to track progress</li>
              <li>Message your clinician with any questions</li>
            </ul>
          </div>
          <div style="text-align: center; margin-top: 24px;">
            <a href="https://app.dontweight.co.uk" style="display: inline-block; background: #38BDF8; color: white; padding: 14px 32px; border-radius: 50px; font-size: 14px; font-weight: 600; text-decoration: none;">Go to Your Portal</a>
          </div>
        </div>
        <div style="text-align: center; margin-top: 20px; color: #999; font-size: 12px;">
          <p style="margin: 0;">Need help? Email <a href="mailto:hello@dontweight.co.uk" style="color: #4a90d9;">hello@dontweight.co.uk</a></p>
        </div>
      </div>
    `,
  }),

  // Order confirmation sent TO the patient
  orderConfirmation: (data) => ({
    to: data.email,
    subject: `Your ${esc(data.treatment)} ${esc(data.dose)} is on its way! 📦`,
    html: `
      <div style="font-family: 'DM Sans', Arial, sans-serif; max-width: 600px; margin: 0 auto; background: #faf9f7; padding: 32px;">
        <div style="text-align: center; margin-bottom: 24px;">
          <h1 style="font-size: 28px; margin: 0;">
            <span style="font-weight: 700; color: #1a1a1a;">don't</span>
            <span style="font-style: italic; font-weight: 300; color: #4a90d9;"> weight</span>
          </h1>
        </div>
        <div style="background: white; border: 1px solid #e5e3df; border-radius: 16px; padding: 32px;">
          <div style="text-align: center; margin-bottom: 20px;">
            <div style="width: 48px; height: 48px; background: #f0fdf4; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 24px;">✅</div>
          </div>
          <h2 style="color: #1a1a1a; font-size: 20px; margin-top: 0; text-align: center;">Order Confirmed</h2>
          <p style="color: #444; font-size: 14px; line-height: 1.6; text-align: center;">
            Great news, ${esc(data.first_name)}! Your treatment has been approved and is being prepared.
          </p>
          <div style="background: #faf9f7; border-radius: 12px; padding: 20px; margin: 20px 0;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
              <tr>
                <td style="padding: 6px 0; color: #666;">Treatment</td>
                <td style="padding: 6px 0; color: #1a1a1a; font-weight: 600; text-align: right;">${esc(data.treatment)} ${esc(data.dose)}</td>
              </tr>
              <tr>
                <td style="padding: 6px 0; color: #666;">Monthly cost</td>
                <td style="padding: 6px 0; color: #1a1a1a; font-weight: 600; text-align: right;">&pound;${data.price_monthly ? (data.price_monthly / 100).toFixed(2) : 'N/A'}/month</td>
              </tr>
              <tr>
                <td style="padding: 6px 0; color: #666;">Delivery</td>
                <td style="padding: 6px 0; color: #1a1a1a; text-align: right;">Free tracked next-day (Royal Mail)</td>
              </tr>
            </table>
          </div>
          <p style="color: #444; font-size: 13px; line-height: 1.6;">
            <strong>What happens next:</strong><br/>
            Your medication will arrive in discreet packaging within 2-3 working days. You'll receive a Royal Mail tracking number by email once dispatched.
          </p>
          <div style="text-align: center; margin-top: 24px;">
            <a href="https://app.dontweight.co.uk" style="display: inline-block; background: #38BDF8; color: white; padding: 14px 32px; border-radius: 50px; font-size: 14px; font-weight: 600; text-decoration: none;">Track Your Delivery</a>
          </div>
          <div style="margin-top: 20px; padding: 12px; background: #eff6ff; border-radius: 8px; font-size: 12px; color: #1e40af;">
            <strong>Included in your plan:</strong> Unlimited clinician messaging, video consultations, AI health assistant, dose adjustments, and dedicated care team support 7 days a week.
          </div>
        </div>
        <div style="text-align: center; margin-top: 20px; color: #999; font-size: 12px;">
          <p style="margin: 0;">Questions? Email <a href="mailto:support@dontweight.co.uk" style="color: #4a90d9;">support@dontweight.co.uk</a></p>
          <p style="margin: 8px 0 0;">Pause or cancel anytime · No contracts · No lock-in</p>
        </div>
      </div>
    `,
  }),
}

// Send notification email
export async function sendNotification(type, data) {
  const template = templates[type]
  if (!template) {
    return { success: false, error: `Unknown template: ${type}` }
  }

  const result = template(data)
  const { subject, html } = result
  // If template specifies a 'to' address (patient-facing), use that; otherwise send to admin
  const recipient = result.to || process.env.NOTIFICATION_EMAIL || 'hello@dontweight.co.uk'

  try {
    const info = await transporter.sendMail({
      from: `"Don't Weight" <${process.env.SMTP_USER}>`,
      replyTo: process.env.NOTIFICATION_EMAIL || 'hello@dontweight.co.uk',
      to: recipient,
      subject,
      html,
    })
    return { success: true, messageId: info.messageId }
  } catch (err) {
    return { success: false, error: err.message }
  }
}

// Netlify function handler — allows calling send-notification directly via HTTP
export async function handler(event) {
  if (event.httpMethod !== 'POST') {
    return { statusCode: 405, body: 'Method not allowed' }
  }

  // Simple API key check to prevent abuse
  const apiKey = event.headers['x-api-key'] || event.headers['X-Api-Key']
  if (apiKey !== process.env.NOTIFICATION_API_KEY && process.env.NOTIFICATION_API_KEY) {
    return { statusCode: 401, body: JSON.stringify({ message: 'Unauthorized' }) }
  }

  try {
    const { type, data } = JSON.parse(event.body)
    if (!type || !data) {
      return { statusCode: 400, body: JSON.stringify({ message: 'Missing type or data' }) }
    }

    const result = await sendNotification(type, data)
    return {
      statusCode: result.success ? 200 : 500,
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(result),
    }
  } catch (err) {
    return {
      statusCode: 500,
      body: JSON.stringify({ message: 'Internal error', error: err.message }),
    }
  }
}
