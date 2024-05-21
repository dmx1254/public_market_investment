<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="icon" href="images/logodesk.png" type="image/png">
    <link rel="stylesheet" href="css/faq.css">
</head>

<body>
    <?php include "navbar.php"; ?>
    <main class="content">
        <?php include "sidebar.php"; ?>
        <div class="faq_container">
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> How do I create a new
                    listing?</button>
                <div class="faq_answer">
                    <p>To create a new listing, click on the "Post an Ad" button at the top of the page. Fill in the
                        required details, such as title, description, category, and contact information, then submit
                        your listing for approval.</p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> What are the guidelines for posting an
                    ad?</button>
                <div class="faq_answer">
                    <p>All ads must adhere to our community guidelines, which include no offensive content, no illegal
                        activities, and accurate representation of the product or service being offered. Please refer to
                        our full guidelines on the "Post an Ad" page.</p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> How can I edit or delete my
                    ad?</button>
                <div class="faq_answer">
                    <p>You can edit or delete your ad by logging into your account, navigating to "My Listings," and
                        selecting the ad you wish to modify or remove. Click the "Edit" or "Delete" button as needed.
                    </p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> How do I contact the seller or
                    buyer?</button>
                <div class="faq_answer">
                    <p>To contact a seller or buyer, use the contact information provided in the listing. You can
                        typically reach out via email or phone, depending on the seller's preferred method of
                        communication.</p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> What should I do if I encounter a
                    suspicious listing?</button>
                <div class="faq_answer">
                    <p>If you come across a suspicious listing, please report it to us immediately using the "Report Ad"
                        button found on the listing page. Provide as much detail as possible so we can investigate and
                        take appropriate action.</p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> Are there any fees for posting an
                    ad?</button>
                <div class="faq_answer">
                    <p>Basic ad postings are free of charge. However, we offer premium features, such as highlighted
                        listings and extended visibility, for a small fee. Please refer to our pricing page for more
                        information.</p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> How long will my ad be
                    visible?</button>
                <div class="faq_answer">
                    <p>Ads are typically visible for 30 days. You will receive a notification before your ad expires,
                        and you can choose to renew it if needed.</p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> How do I respond to an offer?</button>
                <div class="faq_answer">
                    <p>When you receive an offer, you will be notified via email or through your account dashboard. You
                        can respond directly to the offer by replying to the message or contacting the buyer using the
                        provided details.</p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> What should I do if I don't receive a
                    response from a buyer?</button>
                <div class="faq_answer">
                    <p>If a buyer does not respond, you can send a follow-up message. If there is still no response
                        after a reasonable period, you may want to consider other potential buyers or relist your item.
                    </p>
                </div>
            </div>
            <div class="faq_item">
                <button class="faq_question"><i class="fas fa-chevron-right"></i> Can I promote my ad?</button>
                <div class="faq_answer">
                    <p>Yes, you can promote your ad by purchasing one of our premium ad options. These options include
                        features such as highlighted listings, top placement, and increased visibility across the site.
                        Visit our promotions page for more details.</p>
                </div>
            </div>
        </div>
    </main>
    <?php include 'mobile-sidebar.php' ?>
    <?php include 'footer.php' ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const faqQuestions = document.querySelectorAll('.faq_question');

            faqQuestions.forEach(question => {
                question.addEventListener('click', function () {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('i');

                    if (answer.style.display === 'block') {
                        answer.style.display = 'none';
                        icon.classList.remove('active');
                    } else {
                        answer.style.display = 'block';
                        icon.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>

</html>