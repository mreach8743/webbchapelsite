import React from 'react';
import { Phone, Users, Clock, MapPin } from 'lucide-react';

const SmallGroupsPage: React.FC = () => {
  return (
    <div className="py-16">
      <div className="container mx-auto px-4">
        <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
          SMALL GROUP MINISTRY
        </h1>
        
        <div className="max-w-4xl mx-auto">
          {/* Current Status Notice */}
          <div className="bg-blue-50 border-l-4 border-blue-400 p-6 mb-8">
            <div className="flex">
              <div className="flex-shrink-0">
                <Users className="h-6 w-6 text-blue-400" />
              </div>
              <div className="ml-3">
                <h3 className="text-lg font-semibold text-blue-800">
                  Small Group Meetings
                </h3>
                <p className="text-blue-700 mt-2">
                  Small Group meetings are done at various times and in various locations Sunday afternoon and evening. If you would like to participate, contact the church office at (972) 241-3293.
                </p>
              </div>
            </div>
          </div>

          {/* About Small Groups */}
          <div className="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">About Our Small Groups</h2>
            <div className="prose prose-lg max-w-none text-gray-700">
              <p className="mb-4">
                In an effort to foster both spiritual growth and relationship connections, Webb Chapel is proud of her small group ministry. Groups are varied, as is the time, and venue of the meetings. Some meet at the church facility, some meet in homes, some have children in their groups, others do not, one group is for women only, most groups meet on Sunday and some meet during the week. One of the groups is in Spanish.
              </p>
              <p className="mb-4">
                Small groups provide an intimate setting for Bible study, prayer, and fellowship. They offer opportunities for deeper relationships and spiritual growth that complement our larger worship services.
              </p>
            </div>
          </div>

          {/* Group Information */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div className="bg-white rounded-lg shadow-lg p-6">
              <h3 className="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <Clock className="h-6 w-6 mr-3 text-church-blue" />
                Meeting Times
              </h3>
              <ul className="space-y-2 text-gray-700">
                <li>• Sunday afternoon groups</li>
                <li>• Sunday evening groups</li>
                <li>• Weekday evening groups</li>
                <li>• Various times to fit your schedule</li>
              </ul>
            </div>

            <div className="bg-white rounded-lg shadow-lg p-6">
              <h3 className="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <MapPin className="h-6 w-6 mr-3 text-church-blue" />
                Meeting Locations
              </h3>
              <ul className="space-y-2 text-gray-700">
                <li>• Church facility</li>
                <li>• Member homes</li>
                <li>• Community centers</li>
                <li>• Online options available</li>
              </ul>
            </div>
          </div>

          {/* Group Types */}
          <div className="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">Types of Groups</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h3 className="text-lg font-semibold text-gray-800 mb-3">Mixed Groups</h3>
                <p className="text-gray-700">
                  Groups with men, women, and families of all ages. These groups focus on general Bible study and fellowship.
                </p>
              </div>
              <div>
                <h3 className="text-lg font-semibold text-gray-800 mb-3">Women's Groups</h3>
                <p className="text-gray-700">
                  Dedicated groups for women to study, pray, and support one another in their faith journey.
                </p>
              </div>
              <div>
                <h3 className="text-lg font-semibold text-gray-800 mb-3">Family Groups</h3>
                <p className="text-gray-700">
                  Groups that welcome children and focus on family-oriented Bible study and activities.
                </p>
              </div>
              <div>
                <h3 className="text-lg font-semibold text-gray-800 mb-3">Spanish Groups</h3>
                <p className="text-gray-700">
                  Groups that meet in Spanish for our Spanish-speaking members and visitors.
                </p>
              </div>
            </div>
          </div>

          {/* Benefits */}
          <div className="bg-gray-50 rounded-lg p-8 mb-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6">Benefits of Small Groups</h2>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
              <div className="text-center">
                <div className="bg-church-blue text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                  <Users className="h-8 w-8" />
                </div>
                <h3 className="text-lg font-semibold text-gray-800 mb-2">Fellowship</h3>
                <p className="text-gray-700">
                  Build meaningful relationships with other believers in a smaller, more intimate setting.
                </p>
              </div>
              <div className="text-center">
                <div className="bg-church-blue text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                  <Clock className="h-8 w-8" />
                </div>
                <h3 className="text-lg font-semibold text-gray-800 mb-2">Spiritual Growth</h3>
                <p className="text-gray-700">
                  Dive deeper into God's Word through focused study and discussion.
                </p>
              </div>
              <div className="text-center">
                <div className="bg-church-blue text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                  <Phone className="h-8 w-8" />
                </div>
                <h3 className="text-lg font-semibold text-gray-800 mb-2">Support</h3>
                <p className="text-gray-700">
                  Receive prayer, encouragement, and practical support from your group members.
                </p>
              </div>
            </div>
          </div>

          {/* Contact Information */}
          <div className="bg-church-blue text-white rounded-lg p-8 text-center">
            <h2 className="text-2xl font-bold mb-4">JOIN A SMALL GROUP</h2>
            <p className="text-lg mb-6">
              Ready to get connected? Contact us to find a group that fits your schedule and interests.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a 
                href="tel:972-241-3293"
                className="bg-white text-church-blue px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors"
              >
                Call: (972) 241-3293
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

export default SmallGroupsPage;
