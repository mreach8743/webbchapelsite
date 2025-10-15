import React from 'react';
import { MapPin, Clock, Users, BookOpen } from 'lucide-react';

const ImNewHerePage: React.FC = () => {
  return (
    <div className="py-16">
      <div className="container mx-auto px-4">
        <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
          I'M NEW HERE
        </h1>
        
        <div className="max-w-4xl mx-auto space-y-12">
          {/* Welcome Section */}
          <div className="bg-white rounded-lg shadow-lg p-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">WELCOME!</h2>
            <p className="text-lg text-gray-700 leading-relaxed">
              Welcome to Webb Chapel church of Christ, and thank you for visiting our website! We would be delighted to have you, your family, and your friends visit with us for worship and Bible study at our facilities in Farmers Branch. We know that it can be intimidating visiting a new church community, but at Webb Chapel, it is impossible to walk through our doors without experiencing our love for God and His people. While here, you will not only be our honored guest, but part of our family of believers.
            </p>
          </div>

          {/* Who We Are Section */}
          <div className="bg-white rounded-lg shadow-lg p-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">WHO WE ARE</h2>
            <div className="prose prose-lg max-w-none text-gray-700">
              <p className="mb-4">
                Webb Chapel church of Christ is a local congregation of Christian believers who have been baptized by immersion into Christ for the remission of sin, attempting to follow the practices and examples of the followers of Christ of the 1st Century. We believe that Jesus founded only one church, and work to reproduce, in contemporary times, the church established on Pentecost in A.D. 33.
              </p>
              <p>
                The Webb Chapel church of Christ is a group of sinners, clinging to the grace of God offered through the sacrifice of His Son, Jesus, upon the cross.
              </p>
            </div>
          </div>

          {/* Public Worship Section */}
          <div className="bg-white rounded-lg shadow-lg p-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">PUBLIC WORSHIP</h2>
            <p className="text-lg text-gray-700 leading-relaxed">
              Using the New Testament as our guide, we gather each first day of the week, Sunday, to partake of the Lord's Supper (Communion), sing, pray and teach. In our worship services our singing is "a cappella". This mean we sing without musical instruments. Our teachings are based on the Bible scriptures, as we believe that the Bible is the only source of what God has revealed to us of Himself, His wishes, His expectations, and His salvation.
            </p>
          </div>

          {/* Service Information */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div className="bg-church-blue text-white rounded-lg p-8">
              <h3 className="text-xl font-bold mb-6 flex items-center">
                <Clock className="h-6 w-6 mr-3" />
                Service Times
              </h3>
              <div className="space-y-4">
                <div>
                  <h4 className="font-semibold">Sunday Morning</h4>
                  <p>9:30 AM - Worship</p>
                  <p>11:00 AM - Bible Classes</p>
                </div>
                <div>
                  <h4 className="font-semibold">Sunday Evening</h4>
                  <p>Small Group Meetings</p>
                </div>
                <div>
                  <h4 className="font-semibold">Wednesday Evening</h4>
                  <p>7:00 PM - Bible Study</p>
                </div>
              </div>
            </div>

            <div className="bg-white rounded-lg shadow-lg p-8">
              <h3 className="text-xl font-bold mb-6 flex items-center text-gray-800">
                <MapPin className="h-6 w-6 mr-3 text-church-blue" />
                Location
              </h3>
              <div className="text-gray-700">
                <p className="font-semibold">Webb Chapel Church of Christ</p>
                <p>13425 Webb Chapel Road</p>
                <p>Farmers Branch, Texas 75234</p>
                <p className="mt-4">
                  <strong>Phone:</strong> (972) 241-3293
                </p>
              </div>
            </div>
          </div>

          {/* What to Expect */}
          <div className="bg-white rounded-lg shadow-lg p-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6 flex items-center">
              <Users className="h-8 w-8 mr-3 text-church-blue" />
              WHAT TO EXPECT
            </h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div>
                <h3 className="text-lg font-semibold text-gray-800 mb-4">Our Worship Style</h3>
                <ul className="space-y-2 text-gray-700">
                  <li>• A cappella singing (no instruments)</li>
                  <li>• Bible-based preaching</li>
                  <li>• Weekly communion</li>
                  <li>• Prayer and fellowship</li>
                </ul>
              </div>
              <div>
                <h3 className="text-lg font-semibold text-gray-800 mb-4">Dress Code</h3>
                <p className="text-gray-700">
                  We welcome you to come as you are. Most people dress in business casual attire, but we have no formal dress code. What matters most is that you're here to worship God.
                </p>
              </div>
            </div>
          </div>

          {/* Bible Study Information */}
          <div className="bg-gray-50 rounded-lg p-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6 flex items-center">
              <BookOpen className="h-8 w-8 mr-3 text-church-blue" />
              BIBLE STUDY OPPORTUNITIES
            </h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h3 className="text-lg font-semibold text-gray-800 mb-3">Sunday Classes</h3>
                <p className="text-gray-700">
                  We offer age-appropriate Bible classes for everyone from 2 years old through adults. Classes begin at 11:00 AM and last approximately 45 minutes.
                </p>
              </div>
              <div>
                <h3 className="text-lg font-semibold text-gray-800 mb-3">Wednesday Evening</h3>
                <p className="text-gray-700">
                  Join us for mid-week Bible study and fellowship. This is a great opportunity to dive deeper into God's Word and connect with other believers.
                </p>
              </div>
            </div>
          </div>

          {/* Contact Information */}
          <div className="bg-church-blue text-white rounded-lg p-8 text-center">
            <h2 className="text-2xl font-bold mb-4">HAVE QUESTIONS?</h2>
            <p className="text-lg mb-6">
              We'd love to help you get connected! Feel free to reach out to us.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a 
                href="tel:972-241-3293"
                className="bg-white text-church-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors"
              >
                Call Us: (972) 241-3293
              </a>
              <a 
                href="/contact"
                className="bg-white text-church-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors"
              >
                Send Us a Message
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ImNewHerePage;
