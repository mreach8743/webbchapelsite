import React from 'react';
import { Calendar, Clock, Users, BookOpen, Music, Utensils } from 'lucide-react';

const SummerLearningCampPage: React.FC = () => {
  return (
    <div className="w-full">
      {/* Hero Section */}
      <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white py-16">
        <div className="container mx-auto px-4">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-4">
              Summer Learning Camp
            </h1>
            <p className="text-xl md:text-2xl text-blue-100">
              Fun learning and character development for children
            </p>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4 py-12">
        {/* Logo Section */}
        <div className="text-center mb-12">
          <div className="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
            <img 
              src="/images/summerlearningcamp-logo.jpg" 
              alt="Summer Learning Camp Logo" 
              className="mx-auto mb-6 max-w-full h-auto"
            />
            <h2 className="text-3xl font-bold text-gray-800 mb-4">
              Summer Learning Camp 2023
            </h2>
          </div>
        </div>

        {/* Main Information */}
        <div className="max-w-4xl mx-auto mb-12">
          <div className="bg-white rounded-lg shadow-lg p-8">
            <div className="prose prose-lg max-w-none">
              <p className="text-lg text-gray-700 leading-relaxed mb-6">
                <strong>Webb Chapel Church of Christ</strong><br />
                Tuesdays and Thursdays<br />
                10:00am-12:30pm<br />
                June 1- July 13<br />
                Reading Tutoring, Fun with Science, Character Class, Music, and lots of fun!<br />
                Lunch provided<br />
                <strong>All Free!</strong>
              </p>
            </div>
          </div>
        </div>

        {/* Program Details */}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
          <div className="bg-white rounded-lg shadow-lg p-6">
            <BookOpen className="w-12 h-12 text-church-blue mx-auto mb-4" />
            <h3 className="text-xl font-bold text-gray-800 mb-3 text-center">Reading Tutoring</h3>
            <p className="text-gray-600 text-center">
              Individualized reading support to help children improve their literacy skills
            </p>
          </div>

          <div className="bg-white rounded-lg shadow-lg p-6">
            <Users className="w-12 h-12 text-church-blue mx-auto mb-4" />
            <h3 className="text-xl font-bold text-gray-800 mb-3 text-center">Character Class</h3>
            <p className="text-gray-600 text-center">
              Building strong character through fun activities and biblical principles
            </p>
          </div>

          <div className="bg-white rounded-lg shadow-lg p-6">
            <Music className="w-12 h-12 text-church-blue mx-auto mb-4" />
            <h3 className="text-xl font-bold text-gray-800 mb-3 text-center">Music</h3>
            <p className="text-gray-600 text-center">
              Musical activities and learning to develop creativity and rhythm
            </p>
          </div>
        </div>

        {/* Schedule Information */}
        <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white rounded-lg p-8 mb-12">
          <h2 className="text-3xl font-bold text-center mb-8">
            Program Schedule
          </h2>
          
          <div className="grid md:grid-cols-2 gap-8">
            <div className="flex items-center">
              <Calendar className="w-8 h-8 mr-4" />
              <div>
                <h3 className="text-xl font-bold">Days</h3>
                <p className="text-blue-100">Tuesdays and Thursdays</p>
              </div>
            </div>
            
            <div className="flex items-center">
              <Clock className="w-8 h-8 mr-4" />
              <div>
                <h3 className="text-xl font-bold">Time</h3>
                <p className="text-blue-100">10:00 AM - 12:30 PM</p>
              </div>
            </div>
            
            <div className="flex items-center">
              <Calendar className="w-8 h-8 mr-4" />
              <div>
                <h3 className="text-xl font-bold">Duration</h3>
                <p className="text-blue-100">June 1 - July 13</p>
              </div>
            </div>
            
            <div className="flex items-center">
              <Utensils className="w-8 h-8 mr-4" />
              <div>
                <h3 className="text-xl font-bold">Lunch</h3>
                <p className="text-blue-100">Provided daily</p>
              </div>
            </div>
          </div>
        </div>

        {/* Activities Grid */}
        <div className="grid md:grid-cols-2 gap-8">
          <div className="bg-white rounded-lg shadow-lg p-6">
            <h3 className="text-2xl font-bold text-gray-800 mb-4">What We Offer</h3>
            <ul className="space-y-3">
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Reading Tutoring</span>
              </li>
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Fun with Science</span>
              </li>
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Character Development</span>
              </li>
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Music Activities</span>
              </li>
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Interactive Learning</span>
              </li>
            </ul>
          </div>

          <div className="bg-white rounded-lg shadow-lg p-6">
            <h3 className="text-2xl font-bold text-gray-800 mb-4">Program Benefits</h3>
            <ul className="space-y-3">
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Completely Free</span>
              </li>
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Lunch Provided</span>
              </li>
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Safe Environment</span>
              </li>
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Experienced Teachers</span>
              </li>
              <li className="flex items-start">
                <span className="w-2 h-2 bg-church-blue rounded-full mt-2 mr-3"></span>
                <span>Fun Activities</span>
              </li>
            </ul>
          </div>
        </div>

        {/* Call to Action */}
        <div className="mt-12 text-center">
          <div className="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
            <h2 className="text-2xl font-bold text-gray-800 mb-4">
              Ready to Join?
            </h2>
            <p className="text-gray-600 mb-6">
              Contact us for more information or to register your child for the Summer Learning Camp.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a 
                href="/contact" 
                className="bg-church-blue text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors"
              >
                Contact Us
              </a>
              <a 
                href="/imnewhere" 
                className="bg-gray-200 text-gray-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors"
              >
                Learn More
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SummerLearningCampPage;
